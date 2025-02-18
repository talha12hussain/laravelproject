<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyNewForm;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;

class PropertyNewFormController extends Controller
{
   
     // Display all properties
     public function update(Request $request, $id)
     {
         // پراپرٹی تلاش کریں
         $property = PropertyNewForm::findOrFail($id);
     
         // ویلیڈیشن (اگر آپ چاہیں تو)
         $request->validate([
             'property_type' => 'required|string',
             'city' => 'required|string',
             'address' => 'required|string',
             'property_size' => 'required|string',
             'asking_price' => 'required|numeric',
             'agent_name' => 'required|string',
             'images' => 'nullable|array',
             'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // اگر تصاویر اپ لوڈ ہو رہی ہیں
         ]);
     
         // پراپرٹی اپ ڈیٹ کریں
         $property->property_type = $request->input('property_type');
         $property->city = $request->input('city');
         $property->address = $request->input('address');
         $property->property_size = $request->input('property_size');
         $property->asking_price = $request->input('asking_price');
         $property->agent_name = $request->input('agent_name');
     
         // اگر نئی تصاویر ہیں تو اپ لوڈ کریں
         if ($request->hasFile('images')) {
             $images = [];
             foreach ($request->file('images') as $image) {
                 $images[] = $image->store('property_images', 'public');
             }
             $property->images = implode(',', $images);
         }
     
         // پراپرٹی محفوظ کریں
         $property->save();
     
         // سیشن میں اپ ڈیٹ کا پیغام
         return redirect()->back()->with('update', 'Property updated successfully');
     }
     

     
         // Display all properties for admin
         public function show(Request $request)
         {
             $query = PropertyNewForm::query(); // تمام پراپرٹیز کو حاصل کرنے کے لیے کوئری بنائیں
     
             // اگر سرچ انپٹ موجود ہو تو فلٹر لگائیں
             if ($request->filled('search')) {
                 $query->where('property_type', 'like', '%' . $request->search . '%')
                       ->orWhere('city', 'like', '%' . $request->search . '%')
                       ->orWhere('address', 'like', '%' . $request->search . '%')
                       ->orWhere('agent_name', 'like', '%' . $request->search . '%');
             }
     
             // کوئری سے ڈیٹا حاصل کریں اور پیجینیشن کریں
             $properties = $query->paginate(10);
     
             // ڈیٹا کو ویو کے ساتھ واپس کریں
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
            'corner_property' => $request->corner_property === 'yes',
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


