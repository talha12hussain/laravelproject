<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyNewForm;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class PropertyNewFormController extends Controller
{
   
     // Display all properties
     public function update(Request $request, $id)
     {
         // Search for property
         $property = PropertyNewForm::findOrFail($id);
     
// Validation (if you want)
              $request->validate([
            
            'type' => 'required|string',
        'property_type' => 'required|string',
        'city' => 'required|string',
        'property_types' => 'nullable|string',
        'address' => 'required|string',
        'nearest_landmark' => 'nullable|string',
        'floor' => 'nullable|string',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'property_size' => 'required|string',
        'asking_price' => 'required|numeric',
        'corner_property' => 'nullable|string|in:yes,no',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'contact_no' => 'required|string',
        'agent_name' => 'required|string',
        'description' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
         ]);
     
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
         $property->latitude = $request->input('latitude');
         $property->longitude = $request->input('longitude');; 

     
         if ($request->hasFile('images')) {
             $images = [];
             foreach ($request->file('images') as $image) {
                 $images[] = $image->store('property_images', 'public');
             }
             $property->images = implode(',', $images);
         }
     
         $property->save();
     
         return redirect()->back()->with('update', 'Property updated successfully');
     }
     

     
         // Display all properties for admin
         public function show(Request $request)
         {
             $query = PropertyNewForm::query(); 
     
             if ($request->filled('search')) {
                 $query->where('property_type', 'like', '%' . $request->search . '%')
                       ->orWhere('city', 'like', '%' . $request->search . '%')
                       ->orWhere('address', 'like', '%' . $request->search . '%')
                       ->orWhere('agent_name', 'like', '%' . $request->search . '%');
             }
     
             $properties = $query->paginate(10);
     
             return view('admin.dashboard.propertyTable', compact('properties'));
         }
     
         // Delete a property
         public function destroy($id)
         {
             $property = PropertyNewForm::find($id);
     
             if ($property) {
                 $property->delete();
                 return redirect()->back()->with('delete', 'Property deleted successfully!');
             } else {
                 return redirect()->back()->with('error', 'Property not found!');
             }
         }

         public function export()
         {
             return Excel::download(new PropertiesExport, 'properties.xlsx');
         }

         public function printProperty($id)
         {
             $property = PropertyNewForm::findOrFail($id);
         
             if (is_string($property->images)) {
                 $images = explode(',', $property->images);
             } elseif (is_array($property->images)) {
                 $images = $property->images;
             } else {
                 $images = [];
             }
         
             foreach ($images as $key => $image) {
                 $path = public_path('storage/' . $image);
         
                 if (file_exists($path)) {
                     $type = pathinfo($path, PATHINFO_EXTENSION);
                     $data = file_get_contents($path);
                     // Base64 encode کر کے تصاویر کا URL بنائیں
                     $images[$key] = 'data:image/' . $type . ';base64,' . base64_encode($data);
                 } else {
                     $images[$key] = null;
                 }
             }
         
             $property->images = $images;
             $mapUrl = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $property->latitude . ',' . $property->longitude .
             '&zoom=15&size=600x400&markers=' . $property->latitude . ',' . $property->longitude . '&key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8';
     
         // Google Map کی Static Image کو Base64 میں تبدیل کریں
         $mapPath = file_get_contents($mapUrl);
         $mapBase64 = 'data:image/jpeg;base64,' . base64_encode($mapPath);
     
         // Map image کو property کے ساتھ شامل کریں
         $property->mapImage = $mapBase64;
         
             // PDF تیار کریں اور ڈاؤن لوڈ کے لیے واپس کریں
             $pdf = PDF::loadView('admin.dashboard.print', compact('property'));
             return $pdf->download('property_' . $id . '.pdf');
         }
         
         
    public function store(Request $request)
    {

       
        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('property_images', 'public');
            }
        }

        // Save the property data
        $property = PropertyNewForm::create([

            'type' => $request->type, // Add 'type'
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
            'corner_property' => $request->corner_property === 'yes' ? 'yes' : 'no', // Store 'yes' or 'no'
            'images' => $images,
            'contact_no' => $request->contact_no,
            'agent_name' => $request->agent_name,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
           
        ]);

        if ($property) {
            return redirect()->back()->with('success', 'Property added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add property.');
        }
    }

    // Show property details
  

    // Edit property form
    public function edit($id)
    {
        $property = PropertyNewForm::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    // Update property data
  
    // Delete property
   
}


