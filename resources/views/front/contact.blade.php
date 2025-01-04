<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-btn-size/bsb-btn-size.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/margin/margin.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/padding/padding.css">

    <title>Document</title>
</head>

<body>

    <div class="mb-5">
        @include('layouts.navbar')
    </div>

    @include('layouts.hero-sec')


    <div class="container mt-5" style="margin-top:100px !important;">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <h2 class="mb-4 display-5 text-center"><b>@lang('messages.contact_us')</b></h2>
                <p class="text-secondary mb-5 text-center lead fs-4">@lang('messages.contact_us_text')</p>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>
    <main>



        <section>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 ">
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row d-flex justify-content-center">

                    




                    <div class="col-md-8" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                        <form class="shake" role="form" action="{{route('front.contactUsSave')}}" method="POST" id="contactForm" name="contact-form">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="name"><b>@lang('messages.name')</b></label>
                                <input class="form-control" id="name" type="text" placeholder="@lang('messages.name')" name="name"
                                    required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2" for="email"><b>@lang('messages.email')</b></label>
                                <input class="form-control" id="email" type="email" placeholder="@lang('messages.email')"
                                    name="email" required data-error="Please enter your Email">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2"><b>@lang('messages.phone')</b></label>
                                <input class="form-control" id="phone" type="number" name="phone"
                                    placeholder="@lang('messages.phone')" onblur="validateNumber()" required data-error="Please enter your contact here">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="mb-2"><b>@lang('messages.message')</b></label>
                                <textarea class="form-control" rows="3" id="message" placeholder="@lang('messages.message')"
                                    name="message" required data-error="Write your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-submit d-flex justify-content-center mt-4 mb-5">
                                <button type="submit" class="btn btn-primary"  id="form-submit"><i
                                        class="material-icons mdi mdi-message-outline"></i> @lang('messages.send_message')</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>


    @include('layouts.footer')

</body>
<script>
    function validateNumber(){
        var phone = document.getElementById('phone').value;
        if(phone.length < 11  || phone.length > 11){
            alert('Please enter a valid phone number');
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>