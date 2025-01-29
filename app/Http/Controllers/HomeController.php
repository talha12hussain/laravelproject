<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Floor;
use App\Models\Property;
use Mail;
use App\Models\PropertyImages;
use Illuminate\Http\Request;
use App\Models\PropertyNewForm;


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

    public function showHome(Request $request)
{
    $query = PropertyNewForm::with('images');

    if ($request->has('id')) {
        $query->where('id', $request->input('id'));
    }

    if ($request->has('agent_id') && $request->has('id')) {
        $query->whereNot(function ($q) use ($request) {
            $q->where('id', $request->input('id'))
              ->where('agent_id', $request->input('agent_id'));
        });
    }

    // پراپرٹیز حاصل کریں
    $all_home = $query->get();

    // ویو میں ڈیٹا پاس کریں
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
        // `PropertyNewForm` کے ساتھ تصاویر لوڈ کریں
        $single_property = PropertyNewForm::with('images')->findOrFail($id);
    
        return view('front.single-property', compact('single_property'));
    }
    
    public function singlefloor(string $id, string $agent_id)
    {
        // پراپرٹی اور ایجنٹ حاصل کریں
        $single_property = PropertyNewForm::with('agent')->find($id);
    
        // اگر پراپرٹی نہ ملے تو ری ڈائریکٹ کریں
        if (!$single_property) {
            return redirect()->back()->with('error', 'Property not found.');
        }
    
        // ایجنٹ حاصل کریں جو پراپرٹی کی ایجنٹ آئی ڈی کے ساتھ میچ کرے
        $agent = $single_property->agent;
    
        // اگر ایجنٹ نہ ملے تو ری ڈائریکٹ کریں
        if (!$agent || $agent->id != $agent_id) {
            return redirect()->back()->with('error', 'Agent not found.');
        }
    
        // جیو لوکیشن کے لیے ایڈریس استعمال کریں
        $address = $single_property->address;
        $coordinates = $this->getCoordinates($address);
        // This will display the coordinates and stop execution

        // ویو میں ڈیٹا بھیجیں
        return view('front.single-floor', compact('single_property', 'agent', 'coordinates'));
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
    // ابتدائی کوئری - PropertyNewForm ماڈل کے ساتھ images کی معلومات
    $query = PropertyNewForm::with('images');

    // اگر 'id' دیا گیا ہے، تو صرف اسی پراپرٹی کو فلٹر کریں
    if ($request->has('id')) {
        $query->where('id', $request->input('id'));
    }

    if ($request->has('agent_id') && $request->has('id')) {
        $query->whereNot(function ($q) use ($request) {
            $q->where('id', $request->input('id'))
              ->where('agent_id', $request->input('agent_id'));
        });
    } elseif ($request->has('agent_id')) {
        $query->where('agent_id', '!=', $request->input('agent_id'));
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('property_type', 'like', '%' . $request->search . '%')
              ->orWhere('city', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%')
              ->orWhere('agent_name', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->has('type') && in_array($request->input('type'), ['rent', 'sell'])) {
        $query->where('type', $request->input('type'));
    }

    if ($request->has('property_type') && in_array($request->input('property_type'), ['plot', 'commercial', 'residential'])) {
        $query->where('property_type', $request->input('property_type'));
    }

    $perPage = $request->input('per_page', 10);
    if (!is_numeric($perPage) || $perPage <= 0) {
        $perPage = 10;
    }

    $all_home = $query->paginate($perPage);

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
