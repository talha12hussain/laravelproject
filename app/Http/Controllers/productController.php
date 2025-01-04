<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Exports\PropertyExport;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Property;
use App\Models\PropertyImages;
use Exception;
use App\Models\Agent;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminProfile(){

        $user = Auth::guard('web')->user();

        $agent = Agent::all()->count();
        $properties = Property::all()->count();
        $floor = Floor::all()->count();


        return view('admin.dashboard.profile', compact('user', 'agent', 'properties', 'floor'));
    }

    public function createPropertyForm(){
        return view('admin.dashboard.createProperty');
    }

    public function editPropertyForm(string $id){
        $property = Property::findOrFail($id);

        $property_images = PropertyImages::where('property_id', $id)->get();

        return view('admin.dashboard.editProperty', compact('property', 'property_images'));
    }

    public function showProperty(string $id){
        $propertyshow = Property::findOrFail($id);
        return view('admin.dashboard.showProperty', compact('propertyshow'));
    }

    public function agentPropertyForm(){
        return view('admin.dashboard.agentCreateProperty');
    }

    // public function floorDelete(Request $request, ){

    // }

 
public function agentRequest(Request $request)
{
   
    $search = $request->input('search');

    
    $agentRequested = Agent::where('status', 1)
                            ->where(function ($query) use ($search) {
                                if ($search) {
                                    $query->where('agencyName', 'like', "%$search%")
                                          ->orWhere('agencyAddress', 'like', "%$search%");
                                }
                            })
                            ->paginate(10);

   
    return view('admin.dashboard.agentRequest', compact('agentRequested', 'search'));
}

public function agentList(Request $request)
{
    $search = $request->input('search');

    
    $agentList = Agent::where('status', 2)
                        ->where(function ($query) use ($search) {
                            if ($search) {
                                $query->where('agencyName', 'like', "%$search%")
                                      ->orWhere('agencyAddress', 'like', "%$search%");
                            }
                        })
                        ->paginate(10);

    
    return view('admin.dashboard.agentList', compact('agentList', 'search'));

}


    

public function updatePropertyForm(Request $request, string $id)
{
    \DB::beginTransaction(); // Start a database transaction

    try {
        $property = Property::findOrFail($id);

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
            'floors.*.floorNo' => 'numeric',
            'floors.*.suitNo' => 'numeric',
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


        // Update Property details
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

        // Handle file upload
        if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $fileExtension = $image->getClientOriginalExtension();
                    $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
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

       

        $property->update($request->except('file'));

        // Handle Floors
        $floors = $request->floors;
        $floorSuitCombination = [];

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

        \DB::commit(); // Commit the transaction

        return redirect()->route('admin.dashboard.propertyTable', $property->id)->with('update', 'Property updated successfully.');

    } catch (Exception $e) {
        \DB::rollBack(); // Ensure rollback in case of any exception
        \Log::error('Error updating property:', ['exception' => $e]);

        return redirect()->back()->with('error', 'An error occurred while updating the property.')->withInput();
    }
}



    public function storePropertyForm(Request $request): RedirectResponse
    {
        \DB::beginTransaction(); // Start a database transaction
    
        try {
            $request->validate([
                'name' => 'required|string|max:55',
                'address' => 'required|string|max:200',
                'plotSize' => 'required|numeric',
                'dimFront' => 'required|numeric',
                'dimWidth' => 'required|numeric',
                'totalSize' => 'required|string|max:2000000000',
                'leasedArea' => 'numeric',
                'nearestLand' => 'required|string|max:255',
                'corner' => 'required|string',
                'parkingcap' => 'required|numeric',
                'demandSqft' => 'required|string|max:2000000000',
                'absValue' => 'string|max:2000000000',
                'agentname' => 'required|string|max:255',
                'agentcontact' => 'required|numeric',
                'agentdetail' => 'required|string',
                'contactPerson' => 'required|string',
                'plot_type' => 'nullable|in:commercial,warehouse,shop,showroom',
                'size_type' => 'nullable|in:sq_yard,acre,sq_fit',
                'images.*' => 'required|file|mimes:jpeg,png,svg|max:4028',
                'floors.*.floorNo' => 'numeric',
                'floors.*.suitNo' => 'numeric',
                'floors.*.areaSqft' => 'required|numeric',
                'floors.*.rateSqft' => 'required|numeric',
                'floors.*.type' => 'required|string|in:rent,sell',
            ]);

            if(strlen($request->agentcontact) != 11){
                return redirect()->back()->with('error', 'Agent contact number must be 11 digits');
            }

            
    
            // Create Property
            $property = Property::create([
                'name' => $request->name,
                'address' => $request->address,
                'plotSize' => $request->plotSize,
                'dimFront' => $request->dimFront,
                'dimWidth' => $request->dimWidth,
                'totalSize' => $request->totalSize,
                'leasedArea' => $request->leasedArea,
                'nearestLand' => $request->nearestLand,
                'corner' => $request->corner,
                'plot_type' => $request->plot_type,
                'size_type' => $request->size_type,
                'parkingcap' => $request->parkingcap,
                'demandSqft' => $request->demandSqft,
                'absValue' => $request->absValue,
                'agentname' => $request->agentname,
                'agentcontact' => $request->agentcontact,
                'agentdetail' => $request->agentdetail,
                'contactPerson' => $request->contactPerson,
            ]);
    
            // Handle Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $fileExtension = $image->getClientOriginalExtension();
                    $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
                    $filePath = $image->storeAs('uploads/property_images', $fileName, 'public');
    
                    PropertyImages::create([
                        'property_id' => $property->id,
                        'file_path' => $filePath,
                    ]);
                }
            }
    
            // Handle Floors
            $floors = $request->floors;
            $floorSuitCombination = [];
    
            foreach ($floors as $floor) {
                $key = "{$floor['floorNo']}-{$floor['suitNo']}";
    
                if (isset($floorSuitCombination[$key])) {
                    if ($floorSuitCombination[$key] == $floor['type']) {
                        \DB::rollBack(); // Rollback transaction on error
                        return redirect()->back()->withErrors(['floors.*.type' => 'Floor with this suite number already exists with a different type in the same property'])->withInput();
                    }
                } else {
                    $floorSuitCombination[$key] = $floor['type'];
    
                    $existingFloor = Floor::where('property_id', $property->id)
                        ->where('floorNo', $floor['floorNo'])
                        ->where('suitNo', $floor['suitNo'])
                        ->first();
    
                    if ($existingFloor) {
                        \DB::rollBack(); // Rollback transaction on error
                        return redirect()->back()->with('error', 'Floor with this suite number already exists with the same type in the same property');
                    }
                }
            }
    
            // Save Floors
            foreach ($floors as $floor) {
                Floor::create([
                    'property_id' => $property->id,
                    'floorNo' => $floor['floorNo'],
                    'suitNo' => $floor['suitNo'],
                    'areaSqft' => $floor['areaSqft'],
                    'rateSqft' => $floor['rateSqft'],
                    'type' => $floor['type'],
                ]);
            }
    
            \DB::commit(); // Commit transaction if no errors
            return redirect()->route('admin.dashboard.createProperty')->with('success', 'Property details added successfully');
        } catch (Exception $e) {
            \DB::rollBack(); // 
            \Log::error('Error saving property:', ['exception' => $e]);
    
            $errorMessage = 'An error occurred while adding the property: ' . $e->getMessage();

            return redirect()->back()->with('error', $errorMessage)->withInput();
            
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new PropertyExport, 'properties.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        if(Auth::guard('web')->check()){
            $search = request('search');
            $all_home = Property::where('name', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->paginate(10); // 10 items per page
            return view('admin.dashboard.propertyTable', compact('all_home')); 
        }
        elseif(Auth::guard('agent')->check()){
            $agentId = Auth::guard('agent')->id();
            $search = request('search');
            $properties = Property::where('agent_id', $agentId)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%");
                })
                ->paginate(10); // 10 items per page
            return view('agent.dashboard.agentPropertyTable', compact('properties'));
        }
    }
    


    public function agentProperty()
    {
       $properties = Property::all()->where('agent_id', Auth::guard('agent')->id());

        return view('admin.dashboard.agentPropertyTable', compact('properties'));
        }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function agentStatus(Request $request, $agentId)
    {
        $agent = Agent::find($agentId);


        
        if ($agent) {
            // Update the agent's status with the new value from the form
            $agent->status = $request->status;
            $agent->save();
        }


        return redirect()->back()->with('success', 'Agent status updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $home = Property::findOrFail($id);
        
        if($home){
            foreach(Floor::where('property_id', $home->id)->get() as $floor){
                $floor->delete();

            }

            $home->floors()->delete();
            $home->delete();
            return redirect()->back()->with('delete', 'Property deleted successfully ');
        }

    }

    public function destroyAgent(string $id)
    {
        $agent = Agent::findOrFail($id);
        
        if($agent){

            $agent->delete();
            return redirect()->back()->with('delete', 'Property deleted successfully ');
        }

        foreach(Property::where('agent_id', $agent->id)->get() as $property){
            $property->delete();
        }

    }
};
