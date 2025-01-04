<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\Floor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pdfController extends Controller
{
    


    public function PDFexport(string $id) 
{
    $property = Property::findOrFail($id);
    $floors = Floor::where('property_id', $id)->get();
    $property_image = PropertyImages::where('property_id', $id)->first();

    $coordinates = $this->getCoordinates($property->address);

    $latitude = $coordinates['latitude'];
    $longitude = $coordinates['longitude'];

    $mapUrl = "https://maps.googleapis.com/maps/api/staticmap?center={$latitude},{$longitude}&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7Clabel:P%7C{$latitude},{$longitude}&key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8";

    // Get the map image content from Google API
    $mapImageContent = file_get_contents($mapUrl);

    // Save the map image in storage/app/public/maps/
    $mapImagePath = storage_path('app/public/maps/map_' . $property->id . '.png');
    file_put_contents($mapImagePath, $mapImageContent);

    // Set the correct path for the property image
    $default_image = 'uploads/property_images/default_image.jpg';
    
    if ($property_image && !empty($property_image->file_path)) {
        $image = public_path('storage/' . $property_image->file_path);
    } else {
        $image = public_path('storage/' . $default_image);
    }

    

    
    $data = [
        'title' => 'Estado Properties',
        'date' => date('m/d/Y'),
        'property' => $property,
        'floors' => $floors,
        'estado_address' => 'Address: Building #C-73-C,Mezz Floor, 24th Street, Off Khy-e-Ittehad, Phase-II,D.H.A, Karachi',
        'contact_one' => '0333 2222922',
        'contact_two' => ' 0300 2012602',
        'contact_three' => '0300 2014406',
        'estado_email' => 'siyam@estado.ltd',
        'map_image' => public_path('storage/maps/map_' . $property->id . '.png'),
        'image' => $image,

    ];

    $pdf = Pdf::loadView('admin.dashboard.property-pdf', $data)->setPaper('letter', 'landscape');
    return $pdf->download('property-details.pdf');
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
    
}
