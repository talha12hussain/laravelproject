<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<style>
body {
    background: #ffffff;
    margin-top: 20px;
}

#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;

}

#customers td,
#customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even) {
    background-color: #f2f2f2;
}

#customers tr:hover {
    background-color: #473333;
}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #0d6efd;
    color: white;
}

.text-danger strong {
    color: #0d6efd;
}

.title-head {
    background: #abc7f1;
    margin: 30px;
    text-align: center;


}

.title-footer {
    background: #abc7f1;
    margin: 30px;
    padding: 30px;



}

/* #container {
			background-color: #dcdcdc;
		} */

.page-break {
    page-break-after: always;
}

.property-details {
    display: flex;
    justify-content: center;
    margin: 20px;
    text-align: center;
}
</style>

<body>

    <div class="col-md-12">
        <div class="row">

            <div class="title-head">
                <div class="">
                    <h1 class="text-center text-danger ">Propety : {{ $property->name }}</h1>

                </div>
                <div class="">
                    <h3 class="text-center mx-5 text-danger ">Address : {{ $property->address }}</h3>
                </div>
            </div>


            <div class="row">
                <img src="{{ $image }}" class="property-image" alt="Property Image"
                    style="width:100%; height:500px; background-size:cover;" alt="">
            </div>







            <div class=" col-md-12 d-flex justify-content-center ">

                <div class="row">
                    <div style="width:100% !important; " class="col-md-12">
                        <h1 class="property-details">Property Details</h1>
                    </div>
                </div>

                <hr style="border:1px solid gray; margin-bottom: 5px;">

                <div class="row">
                    <div class="table">
                        <table id="customers">
                            <tr>
                                <th>NAME</th>
                                <th>DETAILS</th>

                            </tr>
                            <tr>
                                <td>Property Name</td>
                                <td>{{ $property->name }}</td>

                            </tr>
                            <tr>
                                <td>Property Address</td>
                                <td>{{ $property->address }}</td>

                            </tr>
                            <tr>
                                <td>Plot Size</td>
                                <td>{{ $property->plotSize }}</td>

                            </tr>
                            <tr>
                                <td>Total Size</td>
                                <td>{{ $property->totalSize }}</td>

                            </tr>
                            <tr>
                                <td>Nearest Land</td>
                                <td>{{ $property->nearestLand }}</td>

                            </tr>
                            <tr>
                                <td>Corner</td>
                                <td>{{ $property->corner }}</td>

                            </tr>
                            <tr>
                                <td>Parking Capacity</td>
                                <td>{{ $property->parkingcap }}</td>

                            </tr>

                        </table>
                    </div>
                </div>

                {{-- <div class="footer">
                <div style="margin-top:30px !important; " class="text-center">
                    <h3 style="text-align:center">Thank You</h3>
                    <hr style="border: #473333 solid 2px;">
                </div>
            </div> --}}

                <div class="page-break"></div>

                <div class="row">
                    <div style="width:100% !important; " class="col-md-12">
                        <h1 class="property-details">Floors Detail</h1>
                    </div>
                </div>

                <hr style="border:1px solid gray; margin-bottom: 5px;">

                <div class="row">
                    <div class="table">
                        <table id="customers">
                            <tr>
                                <th>NAME</th>
                                <th>DETAILS</th>

                            </tr>


                            @foreach ($floors as $floor)
                            @if ( $loop->iteration%3 == 0 )
                            <div class="page-break"></div>
                            @endif

                            <tr>
                                <td>
                                    <h3><b>Floor Number</b></h3>
                                </td>
                                <td>
                                    <h3><b>{{ $floor->floorNo }}</b></h3>
                                </td>
                            </tr>

                            <tr>
                                <td>Suite Number</td>
                                <td>{{ $floor->suitNo }}</td>
                            </tr>

                            <tr>
                                <td>Area Sqft</td>
                                <td>{{ $floor->areaSqft }}</td>
                            </tr>

                            <tr>
                                <td>Rate Sqft</td>
                                <td>{{ $floor->rateSqft }}</td>
                            </tr>

                            <tr>
                                <td>Type</td>
                                <td>{{ $floor->type }}</td>
                            </tr>


                            @endforeach
                        </table>
                        <div class="page-break"></div>


                    </div>
                </div>

                <div class="row">
                    <div style="width:100% !important; " class="col-md-12">
                        <h1 class="property-details">Agent Details</h1>
                    </div>
                </div>

                <hr style="border:1px solid gray; margin-bottom: 5px;">

                <div class="row">
                    <div class="table">
                        <table id="customers">
                            <tr>
                                <th>NAME</th>
                                <th>DETAILS</th>

                            </tr>

                            <tr>
                                <td>Agent Name</td>
                                <td>{{ $property->agentname }}</td>
                            </tr>

                            <tr>
                                <td>Agent Contact</td>
                                <td>{{ $property->agentcontact }}</td>
                            </tr>

                            <tr>
                                <td>Agent Details</td>
                                <td>{{ $property->agentdetail }}</td>
                            </tr>

                            <tr>
                                <td>Contact person</td>
                                <td>{{ $property->contactPerson }}</td>
                            </tr>




                        </table>
                        <div class="page-break"></div>


                    </div>
                </div>
                <div class="row" style="width: 100% !important; height:600px !important;">
                    <h3 class="text-center">Property Location</h3>
                    <div class="map-container text-center">
                        <img src="{{ $map_image }}" alt="Property Location Map" style="width:100%; height:300px;">
                    </div>
                </div>

                <div class="row">
                    <div style="width:100% !important; " class="col-md-12">
                        <h1 class="property-details">Contact Us:</h1>
                    </div>
                </div>

                <hr style="border:1px solid gray; margin-bottom: 5px;">

                <div class="title-footer">
                    <div class="">
                        <h1 class="text-center text-danger ">{{ $title }}</h1>

                    </div>
                    <div class="">
                        <h3 class="text-center mx-5 text-danger ">Address : {{ $estado_address }}</h3>
                    </div>
                    <div class="">
                        <h3 class="text-center mx-5 text-danger ">Contact # 01 : {{ $contact_one }}</h3>
                    </div>
                    <div class="">
                        <h3 class="text-center mx-5 text-danger ">Contact # 02 : {{ $contact_two }}</h3>
                    </div>
                    <div class="">
                        <h3 class="text-center mx-5 text-danger ">Contact # 03 : {{ $contact_three }}</h3>
                    </div>
                    <div class="">
                        <h3 class="text-center mx-5 text-danger ">Email : {{ $estado_email }}</h3>
                    </div>
                </div>

            </div>







        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>