<?php

namespace App\Http\Controllers;

use App\Exports\AgentExport;
use App\Exports\AgentPropertyExport;
use Maatwebsite\Excel\Facades\Excel;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\Floor;
use App\Models\Agent;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PropertyNewForm;
use App\Exports\PropertiesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class agentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function agentProfile(){
        $user = Auth::guard('agent')->user();

        $properties = Property::where('agent_id' ,"=", $user->id)->get();
        
       

        return view('agent.dashboard.profile', compact('user', 'properties'));
    }

    public function agentProperty(Request $request)
    {
        if (Auth::guard('agent')->check()) {
            $agent_id = Auth::guard('agent')->user()->id;
    
            // Query for retrieving properties specific to the logged-in agent
            $query = PropertyNewForm::where('agent_id', $agent_id);
    
            // Apply search filters if provided
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('property_type', 'like', '%' . $request->search . '%')
                      ->orWhere('city', 'like', '%' . $request->search . '%')
                      ->orWhere('address', 'like', '%' . $request->search . '%')
                      ->orWhere('agent_name', 'like', '%' . $request->search . '%');
                });
            }
    
            // Paginate the filtered properties
            $properties = $query->paginate(10);
    
            // Return the view with the agent's properties
            return view('agent.dashboard.agentPropertyTable', compact('properties'));
        }
    
        // Redirect if agent is not logged in
        return redirect()->route('admin.agent-login.login')->with('error', 'Please log in first.');
    }
    
    public function update(Request $request, $id)
    {
        // Search for property
        $property = PropertyNewForm::findOrFail($id);
  
    
        $property->type = $request->input('type');
        $property->property_type = $request->input('property_type');
        $property->city = $request->input('city');
        $property->property_types = $request->input('property_types');
        $property->address = $request->input('address');
        $property->nearest_landmark = $request->input('nearest_landmark');
        $property->floor = $request->input('floor');
        $property->bedrooms = $request->input('bedrooms');
        $property->bathrooms = $request->input('bathrooms');
        $property->property_size = $request->input('property_size');
        $property->asking_price = $request->input('asking_price');
        $property->corner_property = $request->input('corner_property') === 'yes' ? 'yes' : 'no';
        $property->contact_no = $request->input('contact_no');
        $property->agent_name = $request->input('agent_name');
        $property->description = $request->input('description');
         // Update latitude and longitude only if present
   $property->latitude = $request->input('latitude');
   $property->longitude = $request->input('longitude');

    
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('property_images', 'public');
            }
            $property->images = json_encode($images); // Store images as JSON
        }
    
        $property->save();
    
        return redirect()->back()->with('update', 'Property updated successfully');
    }
    
    

    public function export() 
    {
        return Excel::download(new AgentExport, 'agent.xlsx');
    }

    public function agentPropertyExport($agentId) 
    {
        return Excel::download(new AgentPropertyExport($agentId), 'agent-properties.xlsx');
    }



    public function agentPropertyForm(){

        $agent = Auth::guard('agent')->user();

        return view('agent.dashboard.agentCreateProperty', compact('agent'));
    }

    public function agenthome()
    {
        // Get the authenticated agent
        $user = Auth::guard('agent')->user();
    
        // Retrieve all properties for the agent (from Property model)
        $properties = PropertyNewForm::where('agent_id', $user->id)->get();

        \Log::info('Properties:', $properties->toArray());

    // Count the total number of properties
    $totalProperties = $properties->count(); // This gives you the number of properties
        
        // Initialize total floors count
      
        
        // Count the total number of PropertyNewForm records for the agent
        // Count PropertyNewForm records where id exists

        // Pass the totals to the view
        return view('agent.dashboard.agentHome', compact('totalProperties',));
    }
    


    public function storeAgent(Request $request){

        // dd($request->all());
        $request->validate([
            'agencyName'        => 'required|string|max:255',
            'agencyAddress'     => 'required|string|max:455',
            'agencyCity'        => 'required|string|max:255',
            'memName'           => 'string|max:255',
            // 'memNumber'         => 'required|integer|between:2,100000', // Change to string if it's an identifier
            'agentName'         => 'required|string|max:255',
            

            'agentminName'      => 'string|max:255',
            'agentlastName'     => 'required|string|max:255',
            'cnicNum'           => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
            'landline'          => 'required|string',
            // Ensures exactly 13 characters
            'cnicExp'           => 'required|date',
            // 'agentName'         => 'required|string|max:255',
            'agentEmail'        => 'required|email',
            'agentPassword'          => 'required|string|max:12',
            'agentProfile'      => 'required|file|mimes:jpg,jpeg,png,svg',
            'agentCertificate'  => 'nullable|file|mimes:jpg,jpeg,png,svg',
            'cnicVerify'        => 'nullable|file|mimes:jpg,jpeg,png,svg',

        ]);

        // if(strlen($request->cnicNum) != 15){
        //     return redirect()->back()->with('error', 'CNIC number must be 13 digits');
        // }

        $membership_num = Agent::max('memNumber');
        $next_membership_num = $membership_num + 1;

        if ($request->hasFile('agentProfile')) {
            try{
             $file = $request->file('agentProfile');
             $fileExtension = $file->getClientOriginalExtension(); // Get the file extension
             $ProfilefileName = time() . '.' . $fileExtension; // Generate a unique name for the file
             $filePath = $file->storeAs('uploads/agent_profile', $ProfilefileName, 'public');
            }catch(Exception $e){
             Log::error('file upload failed'.$e->getMessage());
            }
         }

         if ($request->hasFile('agentCertificate')) {
            try{
             $file = $request->file('agentCertificate');
             $fileExtension = $file->getClientOriginalExtension(); // Get the file extension
             $CertificatefileName = time() . '.' . $fileExtension; // Generate a unique name for the file
             $filePath = $file->storeAs('uploads/agent_certificate', $CertificatefileName, 'public');
            }catch(Exception $e){
             Log::error('file upload failed'.$e->getMessage());
            }
         }

         if ($request->hasFile('cnicVerify')) {
            try{
             $file = $request->file('cnicVerify');
             $fileExtension = $file->getClientOriginalExtension(); // Get the file extension
             $CnicfileName = time() . '.' . $fileExtension; // Generate a unique name for the file
             $filePath = $file->storeAs('uploads/cnic_verify', $CnicfileName, 'public');
            }catch(Exception $e){
             Log::error('file upload failed'.$e->getMessage());
            }
         }

        //  dd($request->all());

         $agent = new Agent();
         $agent->agencyName = $request->agencyName;
         $agent->agencyAddress = $request->agencyAddress;
         $agent->agencyCity = $request->agencyCity;
         $agent->memName = $request->memName;
         $agent->memNumber = $next_membership_num;
         $agent->agentName = $request->agentName;
         
         $agent->agentminName = $request->agentminName;
         $agent->agentlastName = $request->agentlastName;
         $agent->cnicNum = $request->cnicNum;
         $agent->landline = $request->landline;
         $agent->agentEmail = $request->agentEmail;
         $agent->password = Hash::make($request->agentPassword);
         $agent->cnicExp = $request->cnicExp;

         
        

         

         if ($request->hasFile('agentProfile')) {
            $agent->agentProfile = $ProfilefileName;
        }else {
            $agent->agentProfile = null; // Or set a default value
        }
        if ($request->hasFile('agentCertificate')) {
            $agent->agentCertificate = $CertificatefileName;
        }else {
            $agent->agentCertificate = null; // Or set a default value
        }
        if ($request->hasFile('cnicVerify')) {
            $agent->cnicVerify = $CnicfileName;
        }else {
            $agent->cnicVerify = null; // Or set a default value
        }
     
        $agent->save();


        
        return redirect()->route('admin.agent-login.register')->with('success', 'We will let you know after admin approval');



    }

    public function agentlogin(Request $request)
    {
        // Validate the credentials
        $credential = $request->validate([
            'agentEmail' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to log the agent in
        if (Auth::guard('agent')->attempt(['agentEmail' => $credential['agentEmail'], 'password' => $credential['password']])) {
            // Get the authenticated agent
            $agent = Auth::guard('agent')->user();
    
            // Check agent status and redirect accordingly
            if ($agent->status == 2) {
                return redirect()->route('admin.dashboard.agentHome');
            } elseif ($agent->status == 1) {
                return redirect()->route('admin.agent-login.login')->with('error', 'Your account is not approved yet.');
            } else {
                return redirect()->route('admin.agent-login.login')->with('error', 'Invalid Credentials.');
            }
        } else {
            // Failed login attempt, redirect back to the login form with an error message
            return redirect()->route('admin.agent-login.login')
                ->withErrors(['agentEmail' => 'Invalid credentials, please try again.'])
                ->withInput($request->except('password')); // Keep email input, but not the password
        }
    }
    public function storePropertyForm(Request $request): RedirectResponse
    {
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('property_images', 'public');
            }
        }
    
        try {
            // لاگ ان شدہ ایجنٹ کا ID حاصل کریں
            $agent_id = Auth::guard('agent')->user()->id;
    
            // پراپرٹی کا ریکارڈ بنائیں
            $property = PropertyNewForm::create([
                'type' => $request->type,
                'property_type' => $request->property_type,
                'city' => $request->city,
                'property_types' => $request->property_types,
                'address' => $request->address,
                'nearest_landmark' => $request->nearest_landmark,
                'floor' => $request->floor,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'property_size' => $request->property_size,
                'asking_price' => $request->asking_price,
                'corner_property' => $request->corner_property === 'yes' ? 'yes' : 'no',
                'images' => json_encode($images),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'agent_id' => $agent_id, // لاگ ان شدہ ایجنٹ کا ID محفوظ کریں
                'agent_name' => $request->agent_name,
                'contact_no' => $request->contact_no,
                'description' => $request->description,
            ]);
    
            // کامیابی کا پیغام واپس کریں۔
            return redirect()->back()->with('success', 'Property added successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed to add property: ' . $e->getMessage());
        }
    
        // اگر کسی وجہ سے یہ پوائنٹ پہنچے، تو بھی ایک ریسپانس واپس کریں۔
        return redirect()->back()->with('error', 'An unexpected error occurred.');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPropertyForm(string $id){

        $agent = Auth::guard('agent')->user();

       

        $property = Property::findOrFail($id);
        $property_images = PropertyImages::where('property_id', $property->id)->get();

        return view('agent.dashboard.agentEdit', compact('property', 'property_images'));
    }

    public function updatePropertyForm(Request $request, string $id)
{
    \DB::beginTransaction(); // Start a database transaction

    try {
        $property = Property::findOrFail($id); // Use findOrFail to throw an exception if not found

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'plotSize' => 'required|numeric',
            'dimFront' => 'required|numeric',
            'dimWidth' => 'required|numeric',
            'totalSize' => 'required|string',
            'leasedArea' => 'numeric',
            'nearestLand' => 'required|string|max:255',
            'corner' => 'required|in:Yes,No',
            'parkingcap' => 'required|numeric',
            'demandSqft' => 'required|numeric',
            'plot_type' => 'nullable|in:commercial,warehouse,shop,showroom',
            'size_type' => 'nullable|in:sq_yard,acre,sq_fit',
            'absValue' => 'required|numeric',
            'agentname' => 'required|string|max:255',
            'agentcontact' => 'required|numeric',
            'agentdetail' => 'required|string|max:255',
            'contactPerson' => 'required|string|max:255',
            'images.*' => 'nullable|mimes:jpeg,png,svg|max:2048',
            'floors.*.floorNo' => 'required|numeric',
            'floors.*.suitNo' => 'required|numeric',
            'floors.*.areaSqft' => 'required|numeric',
            'floors.*.rateSqft' => 'required|numeric',
            'floors.*.type' => 'required|in:rent,sell'
        ]);

        if(strlen($request->agentcontact) != 11){
            return redirect()->back()->with('error', 'Agent contact number must be 11 digits');
        }

        if ($request->plot_type == 'warehouse' || $request->plot_type == 'showroom') {
            // Count existing 'warehouse' or 'showroom' entries in the database
            $existingPlotTypeCount = Property::where('plot_type', $request->plot_type)->count();
    
            // If there is already one existing entry, redirect back with error
            if ($existingPlotTypeCount >= 1) {
                return redirect()->back()->withErrors([
                    'plot_type' => 'Only one ' . $request->plot_type . ' is allowed.'
                ])->withInput();
            }
        }

        // Update property details
        $property->name = $request->name;
        $property->address = $request->address;
        $property->plotSize = $request->plotSize;
        $property->dimFront = $request->dimFront;
        $property->dimWidth = $request->dimWidth;
        $property->totalSize = $request->totalSize;
        $property->leasedArea = $request->leasedArea;
        $property->nearestLand = $request->nearestLand;
        $property->corner = $request->corner;
        $property->plot_type = $request->plot_type;
        $property->size_type = $request->size_type;
        $property->parkingcap = $request->parkingcap;
        $property->demandSqft = $request->demandSqft;
        $property->absValue = $request->absValue;
        $property->agentname = $request->agentname;
        $property->agentcontact = $request->agentcontact;
        $property->agentdetail = $request->agentdetail;
        $property->contactPerson = $request->contactPerson;

        // Handle file uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileExtension = $image->getClientOriginalExtension(); // Get the file extension
                $fileName = time() . '_' . uniqid() . '.' . $fileExtension; // Generate a unique name for the file
                $filePath = $image->storeAs('uploads/property_images', $fileName, 'public');

                PropertyImages::create([
                    'property_id' => $property->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        if ($request->has('deleted_images') && !empty($request->deleted_images)) {
            $deletedImageIds = explode(',', $request->deleted_images);
    
            // Remove the images from the database and storage
            foreach ($deletedImageIds as $imageId) {
                $image = PropertyImages::find($imageId);
    
                if ($image) {
                    // Remove the image file from storage
                    Storage::delete('public/' . $image->file_path);
    
                    // Delete the image record from the database
                    $image->delete();
                }
            }
        }

        // Update property data in the database
       $property->update($request->except('file'));

        // Handle floors
        $floors = $request->floors;
        $floorSuiteCombination = [];

        foreach ($floors as $floor) {
            $key = "{$floor['floorNo']}-{$floor['suitNo']}";

            if (isset($floorSuitCombination[$key])) {
                // Check for type conflict
                if ($floorSuitCombination[$key] == $floor['type']) {
                    \DB::rollBack(); // Rollback transaction on error
                    return redirect()->back()->withErrors(['floors.*.type' => 'Floor with this suite number already exists with a different type in the same property'])->withInput();
                }
            } else {
                $floorSuitCombination[$key] = $floor['type'];
            }
        }


        foreach ($floors as $floor) {
            $existingFloor = Floor::where('property_id', $property->id)
             
            ->where('floorNo', $floor['floorNo'])
                ->where('suitNo', $floor['suitNo'])
                ->where('type', $floor['type'])
                ->first();

            if ($existingFloor) {
                $existingFloor->update([
                   
                    'areaSqft' => $floor['areaSqft'],
                    'rateSqft' => $floor['rateSqft'],
                    'type' => $floor['type'],
                ]);
            } else {
                Floor::create([
                    'property_id' => $property->id,
                    'floorNo' => $floor['floorNo'],
                    'suitNo' => $floor['suitNo'],
                    'areaSqft' => $floor['areaSqft'],
                    'rateSqft' => $floor['rateSqft'],
                    'type' => $floor['type'],
                ]);
            }
        }

        if ($request->has('deleted_floor') && !empty($request->deleted_floor)) {
            $deletedFloorIds = explode(',', $request->deleted_floor);
    
            // Remove the images from the database and storage
            foreach ($deletedFloorIds as $floorId) {
                $floor = Floor::find($floorId);
    
                if ($floor) {
                // Delete the image record from the database
                    $floor->delete();
                }
            }
        }

        \DB::commit(); // Commit the transaction if all goes well
        return redirect()->route('agent.dashboard.agentPropertyTable', $property->id)->with('update', 'Property updated successfully.');

    } catch (\Exception $e) {
        \DB::rollBack(); // Roll back the transaction on error
        return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property: ' . $e->getMessage()])->withInput();
    }
}


    /**
     * Update the specified resource in storage.
     */
   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
