<!DOCTYPE html>
<html>
<head>
    <title>Property Details</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Header Styling */
        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        /* Table Styling */
        .details {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .details th, .details td {
            padding: 12px;
            text-align: left;
        }

        .details th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #007bff;
        }

        .details tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Map Styling */
        .map-container {
            text-align: center;
            margin: 40px auto;
            padding: 10px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 80%; /* Adjust map container width */
            max-width: 800px; /* Set maximum width for the map */
            margin-top: 40px;
        }

        .map-container img {
            border-radius: 8px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
            width: 100%; /* Makes the map image full-width */
            height: auto;
        }

        /* Footer Styling */
        .footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Image Gallery Styling */
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
            justify-content: center;
        }

        .image-gallery img {
            width: 250px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .image-gallery img:hover {
            transform: scale(1.05); /* Hover effect for images */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .details {
                width: 90%;
            }

            .map-container {
                width: 90%; /* Adjust map for smaller screen sizes */
            }

            .image-gallery img {
                width: 200px;
                height: 150px;
            }
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>Property Details</h1>
    </div>

    <!-- Property Details Table -->
    <table class="details">
        <tr>
            <th>Property Type:</th>
            <td>{{ $property->property_type }}</td>
        </tr>
        <tr>
            <th> Type:</th>
            <td>{{ $property->type }}</td>
        </tr>
        <tr>
            <th>City:</th>
            <td>{{ $property->city }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $property->address }}</td>
        </tr>
        <tr>
            <th>Nearest_Landmark:</th>
            <td>{{ $property->nearest_landmark }}</td>
        </tr>
        <tr>
            <th>Size:</th>
            <td>{{ $property->property_size }}</td>
        </tr>
        <tr>
            <th>Price:</th>
            <td>{{ number_format($property->asking_price, 2) }}</td>
        </tr>

        @if($property->property_type == 'plot')
            <tr>
                <th>Plot Types:</th>
                <td>{{ $property->property_types }}</td>
            </tr>
        @elseif($property->property_type == 'commercial')
            <tr>
                <th>Floor:</th>
                <td>{{ $property->floor }}</td>
            </tr>
        @elseif($property->property_type == 'residential')
            <tr>
                <th>Bedrooms:</th>
                <td>{{ $property->bedrooms }}</td>
            </tr>
            <tr>
                <th>Bathrooms:</th>
                <td>{{ $property->bathrooms }}</td>
            </tr>
            <tr>
                <th>Floor:</th>
                <td>{{ $property->floor }}</td>
            </tr>
        @endif

        <tr>
            <th>Corner:</th>
            <td>{{ $property->corner_property }}</td>
        </tr>
        <tr>
            <th>Agent Name:</th>
            <td>{{ $property->agent_name }}</td>
        </tr>
        <tr>
            <th>Contact:</th>
            <td>{{ $property->contact_no }}</td>
        </tr>
        <tr>
            <th>Latitude:</th>
            <td>{{ $property->latitude }}</td>
        </tr>
        <tr>
            <th>Longitude:</th>
            <td>{{ $property->longitude }}</td>
        </tr>
    </table>

    <!-- Property Images -->
    <h2>Property Image</h2>
    <div class="image-gallery">
        @if (!empty($property->images))
            @foreach ($property->images as $image)
                @if ($image) <!-- Only display if image exists -->
                    <img src="{{ $image }}" alt="Property Image">
                @else
                    <p>Image not found.</p>
                @endif
            @endforeach
        @else
            <p>No images available for this property.</p>
        @endif
    </div>

    <!-- Property Location Map -->
    <div class="map-container">
        <h2>Property Location</h2>
        <img src="{{ $property->mapImage }}" alt="Property Map">
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Property Management. All Rights Reserved.</p>
    </div>
</body>
</html>
