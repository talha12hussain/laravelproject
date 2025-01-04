<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="property-part flex-column" 
     style="
    background-size:cover;
    background-position:center;
    width:100%;
    background-repeat:no-repeat;
    display: flex;            
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #ffffff; 
    font-family: Arial, sans-serif;
    margin-top : 10px; ">
    
    <div class="">
        <h1 class="text-dark mt-5 mb-5" style="font-size: 50px;"><b>@lang('messages.our_main_focus')</b></h1>
    </div>
    
   

   
</div>

<div class="property container-fluid " 
style="
    background-repeat:no-repeat;
    display: flex;            
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #ffffff; 
    font-family: Arial, sans-serif; 
">
    
        <div class="row d-flex justify-content-center">
            
            <div class=" text-center col-md-3 flex-center mx-3 justify-center align-items-center">
                <div class="card rounded-0 p-2" style="
                display: flex;            
                justify-content: center;
                align-items: center;
                text-align: center;
                color: #ffffff; ">
                    <img class="card-img-top mt-5 text-center " src="{{ asset('icon/sell.png') }}" style="color: #3b82f680; width:120px; hight:120px;" alt="Card image cap">
                    
                    <div class="card-body">
                        <h2 class="card-title text-dark" style="font-size: 40px !important;"><b>@lang('messages.rent')</b></h2>
                        <p class="card-text text-dark mt-4">@lang('messages.rent_des')</p>
                    </div>
                  </div>
            </div>

            <div class=" text-center col-md-3 flex-center mx-3 justify-center align-items-center">
                <div class="card rounded-0 p-2" style="
                display: flex;            
                justify-content: center;
                align-items: center;
                text-align: center;
                color: #ffffff; ">
                    <img class="card-img-top mt-5 text-center " src="{{ asset('icon/rent.png') }}" style="color: #3b82f680; width:120px; hight:120px;" alt="Card image cap">
                    
                    <div class="card-body">
                        <h2 class="card-title text-dark" style="font-size: 40px !important;"><b>@lang('messages.sell')</b></h2>
                        <p class="card-text text-dark mt-4">@lang('messages.sell_des')</p>
                    </div>
                  </div>
            </div>

               

                <div class=" text-center col-md-3 flex-center mx-3 justify-center align-items-center">
                    <div class="card rounded-0 p-2" 
                    style=" display: flex;            
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                    color: #ffffff; ">
                        <img class="card-img-top mt-5 text-blue-500 text-center " src="{{ asset('icon/purchase.png') }}" style="color: #3b82f680; width:120px; hight:120px;" alt="Card image cap">
                        
                        <div class="card-body">
                            <h3 class="card-title text-dark mt-2" style="font-size: 40px !important;"> <b>@lang('messages.purchase')</b> </h3>
                            <p class="card-text text-dark mt-4">@lang('messages.purchase_des')</p>
                        </div>
                      </div>
                </div>

                
        
        </div>
    
   </div>
</body>
</html>