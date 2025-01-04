 <div class="container mt-0">
     <div class="d-flex justify-start align-items-center">
         <h3 class="" style="margin-right:20px">For Rent</h3>
         <button type="button" id="addFloorButtonRent" class="btn btn-primary btn-sm ">Add Floor <b>+</b></button>
     </div>
     <a id="propertyForm">

         <div id="floorContainerRent"></div>
         <button type="submit" class="btn btn-success mt-3">Submit</button>
     </a>
     @error('type')
         <div class="text-danger">{{ $message }}</div>
     @enderror
 </div>
 -
 <hr class="" style="border:0.1px solid rgb(183, 183, 183); margin-top: 40px !important;">

 <div class="container mt-4">
     <div class="d-flex justify-start align-items-center">
         <h3 class="" style="margin-right:30px">For Sell</h3>
         <button type="button" id="addFloorButtonSell" class="btn btn-primary btn-sm ">Add Floor <b>+</b></button>
     </div>
     <a id="propertyForm">

         <div id="floorContainerSell">
         </div>
         {{-- <button type="submit" class="btn btn-success mt-3">Submit</button> --}}
     </a>
     @error('type')
         <div class="text-danger">{{ $message }}</div>
     @enderror
 </div>

 <hr class="" style="border:0.1px solid rgb(183, 183, 183); margin-top: 40px !important;">

 {{-- chatggpt with my modifications --}}

 <div class="container d-flex justify-start align-items-center  ">
     <a type="button" id="addFloorButton" style="font-size: 20px;  " class=" mx-1 text-decoration-none "><b>Add
             Floor</b></a>
     <form id="propertyForm" method="POST" action="/submit">
         <div id="floorContainer"></div>
         <button type="submit" style="font-size: 30px !important;  "
             class="btn btn-white mb-2 border-white border   rounded-circle "><b>+</b></button>
     </form>
 </div>
