<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Floor;
use App\Models\Property;
use Mail;
use App\Models\PropertyImages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        dd('dd checking');
        return view("front.home");
    }

    public function showHome(Request $request){


        $all_home = Property::all();
        return view('front.home', compact('all_home'));

    }

    // public function filterByCity(Request $request){

    //     $property = $request->input('property');


    //     $all_home = Property::all();

        
        
    //     return view('front.properties', compact('all_home'));
    // }

    public function about()
    {
        return view('front.about');
    }

    public function privacy()
    {
        return view('front.privacy');
    }

    public function terms()
    {
        return view('front.terms');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function singleProperty(string $id, Request $request)
{
    $single_property = Property::with(['images'])->findOrFail($id);

    // Check if a filter is applied
    $floor_type = $request->query('type');

    // Filter floors by type if selected, otherwise retrieve all floors
    if ($floor_type) {
        $floors = $single_property->floors->where('type', $floor_type);
    } else {
        $floors = $single_property->floors;
    }

    $floor_count = $floors->count();

    return view('front.single-property', compact('floor_count', 'single_property', 'floors'));
}

    public function singlefloor(string $id, string $floorId ){

        // dd($id, $floorId);

        $property = Property::with(['floors', 'images'])->find($id);

        if (!$property) {
            return redirect()->back()->with('error', 'Property not found.');
        }

        $floor = $property->floors->where('id',$floorId)->first();

        if (!$floor) {
            return redirect()->back()->with('error', 'Floor not found.');
        }

        $address = $property->address;

        $coordinates = $this->getCoordinates($address);


        return view('front.single-floor', compact('floor', 'property', 'coordinates'));
    }


    public function getCoordinates($address){
        $apiKey = 'AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8';
        $formattedAddress = urlencode($address);

      $url  = "https://maps.googleapis.com/maps/api/geocode/json?address={$formattedAddress}&key={$apiKey}";

      $response = file_get_contents($url);
      $json = json_decode($response, true);

      if (isset($json['results'][0])) {
        $latitude = $json['results'][0]['geometry']['location']['lat'];
        $longitude = $json['results'][0]['geometry']['location']['lng'];
        return ['latitude' => $latitude, 'longitude' => $longitude];
    } else {
        return ['latitude' => 0, 'longitude' => 0];  // Fallback if address not found
    }


    }
    


    public function properties(Request $request)
{
    // Initial query
    $query = Property::with(['floors', 'images']);
    
    // Search functionality
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('address', 'like', '%' . $search . '%');
        });
    }
    
    // Filter by rent or sell
    if ($request->has('type')) {
        $filter = $request->input('type');
        if ($filter === 'rent') {
            $query->whereHas('floors', function($q) {
                $q->where('type', 'rent');
            });
        } elseif ($filter === 'sell') {
            $query->whereHas('floors', function($q) {
                $q->where('type', 'sell');
            });
        }
    }

    // Filter by property type
    if ($request->has('property_type')) {
        $propertyType = $request->input('property_type');
        if ($propertyType) {
            $query->where('plot_type', $propertyType);
        }
    }

    // Paginate the results
    $all_home = $query->paginate(10);
    
    return view('front.properties', compact('all_home'));
}
    



    public function contactUsSave(Request $request){
      $request->validate(
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]
      );

      $contact = new ContactUs();
      $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $admin = "info@estado.ltd";

        Mail::send('email.contactUs', ['contact'=> $contact], function($message) use ($admin){
            $message->to($admin)
            ->subject('Estado Message Querries');
        }

        );

        return redirect()->back()->with('success', 'Your message has been sent successfully.');

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
