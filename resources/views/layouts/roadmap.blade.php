<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
.main-timeline4 {
    overflow: hidden;
    position: relative
}

.main-timeline4:before {
    content: "";
    width: 5px;
    height: 70%;
    background: #333;
    position: absolute;
    top: 70px;
    left: 50%;
    transform: translateX(-50%)
}

.main-timeline4 .timeline-content:before,
.main-timeline4 .timeline:before {
    top: 50%;
    transform: translateY(-50%);
    content: ""
}

.main-timeline4 .timeline {
    width: 50%;
    padding-left: 100px;
    float: right;
    position: relative
}

.main-timeline4 .timeline:before {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    border: 5px solid #333;
    position: absolute;
    left: -10px
}

.main-timeline4 .timeline-content {
    display: block;
    padding-left: 150px;
    position: relative
}

.main-timeline4 .timeline-content:before {
    width: 90px;
    height: 10px;
    border-top: 7px dotted #333;
    position: absolute;
    left: -92px
}

.main-timeline4 .year {
    display: inline-block;
    width: 120px;
    height: 120px;
    line-height: 100px;
    border-radius: 50%;
    border: 10px solid #f54957;
    font-size: 30px;
    color: #f54957;
    text-align: center;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, .4);
    position: absolute;
    top: 0;
    left: 0
}

.main-timeline4 .year:before {
    content: "";
    border-left: 20px solid #f54957;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    position: absolute;
    bottom: -13px;
    right: 0;
    transform: rotate(45deg)
}

.main-timeline4 .inner-content {
    padding: 20px 0
}

.main-timeline4 .title {
    font-size: 24px;
    font-weight: 600;
    color: #f54957;
    text-transform: uppercase;
    margin: 0 0 5px
}

.main-timeline4 .description {
    font-size: 14px;
    color: #6f6f6f;
    margin: 0 0 5px
}

.main-timeline4 .timeline:nth-child(2n) {
    padding: 0 100px 0 0
}

.main-timeline4 .timeline:nth-child(2n) .timeline-content:before,
.main-timeline4 .timeline:nth-child(2n) .year,
.main-timeline4 .timeline:nth-child(2n):before {
    left: auto;
    right: -10px
}

.main-timeline4 .timeline:nth-child(2n) .timeline-content {
    padding: 0 150px 0 0
}

.main-timeline4 .timeline:nth-child(2n) .timeline-content:before {
    right: -92px
}

.main-timeline4 .timeline:nth-child(2n) .year {
    right: 0
}

.main-timeline4 .timeline:nth-child(2n) .year:before {
    right: auto;
    left: 0;
    border-left: none;
    border-right: 20px solid #f54957;
    transform: rotate(-45deg)
}

.main-timeline4 .timeline:nth-child(2) {
    margin-top: 110px
}

.main-timeline4 .timeline:nth-child(odd) {
    margin: -110px 0 0
}

.main-timeline4 .timeline:nth-child(even) {
    margin-bottom: 80px
}

.main-timeline4 .timeline:first-child,
.main-timeline4 .timeline:last-child:nth-child(even) {
    margin: 0
}

.main-timeline4 .timeline:nth-child(2n) .year {
    border-color: #1ebad0;
    color: #1ebad0
}

.main-timeline4 .timeline:nth-child(2) .year:before {
    border-right-color: #1ebad0
}

.main-timeline4 .timeline:nth-child(2n) .title {
    color: #1ebad0
}

.main-timeline4 .timeline:nth-child(3n) .year {
    border-color: #7cba01;
    color: #7cba01
}

.main-timeline4 .timeline:nth-child(3) .year:before {
    border-left-color: #7cba01
}

.main-timeline4 .timeline:nth-child(3n) .title {
    color: #7cba01
}

.main-timeline4 .timeline:nth-child(4n) .year {
    border-color: #f8781f;
    color: #f8781f
}

.main-timeline4 .timeline:nth-child(4) .year:before {
    border-right-color: #f8781f
}

.main-timeline4 .timeline:nth-child(4n) .title {
    color: #f8781f
}

@media only screen and (max-width:1200px) {
    .main-timeline4 .year {
        top: 50%;
        transform: translateY(-50%)
    }
}

@media only screen and (max-width:990px) {
    .main-timeline4 .timeline {
        padding-left: 75px
    }

    .main-timeline4 .timeline:nth-child(2n) {
        padding: 0 75px 0 0
    }

    .main-timeline4 .timeline-content {
        padding-left: 130px
    }

    .main-timeline4 .timeline:nth-child(2n) .timeline-content {
        padding: 0 130px 0 0
    }

    .main-timeline4 .timeline-content:before {
        width: 68px;
        left: -68px
    }

    .main-timeline4 .timeline:nth-child(2n) .timeline-content:before {
        right: -68px
    }
}

@media only screen and (max-width:767px) {
    .main-timeline4 {
        overflow: visible
    }

    .main-timeline4:before {
        height: 100%;
        top: 0;
        left: 0;
        transform: translateX(0)
    }

    .main-timeline4 .timeline:before,
    .main-timeline4 .timeline:nth-child(2n):before {
        top: 60px;
        left: -9px;
        transform: translateX(0)
    }

    .main-timeline4 .timeline,
    .main-timeline4 .timeline:nth-child(even),
    .main-timeline4 .timeline:nth-child(odd) {
        width: 100%;
        float: none;
        text-align: center;
        padding: 0;
        margin: 0 0 10px
    }

    .main-timeline4 .timeline-content,
    .main-timeline4 .timeline:nth-child(2n) .timeline-content {
        padding: 0
    }

    .main-timeline4 .timeline-content:before,
    .main-timeline4 .timeline:nth-child(2n) .timeline-content:before {
        display: none
    }

    .main-timeline4 .timeline:nth-child(2n) .year,
    .main-timeline4 .year {
        position: relative;
        transform: translateY(0)
    }

    .main-timeline4 .timeline:nth-child(2n) .year:before,
    .main-timeline4 .year:before {
        border: none;
        border-right: 20px solid #f54957;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        top: 50%;
        left: -23px;
        bottom: auto;
        right: auto;
        transform: rotate(0)
    }

    .main-timeline4 .timeline:nth-child(2n) .year:before {
        border-right-color: #1ebad0
    }

    .main-timeline4 .timeline:nth-child(3n) .year:before {
        border-right-color: #7cba01
    }

    .main-timeline4 .timeline:nth-child(4n) .year:before {
        border-right-color: #f8781f
    }

    .main-timeline4 .inner-content {
        padding: 10px
    }
}
</style>

<body>

    <div class="container">

        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="text-center my-5" style="font-size:58px; margin-top:60px !important;"><b>@lang('messages.journey_to_your_dream_apartment')</b></h1>
                <div class="main-timeline4" style="margin-top:100px !important;">
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year  align-items-center "><x-heroicon-o-user-group class="mt-1 align-items-center" style="width:80%; height:80%; "/></span>
                            <div class="inner-content">
                                <h3 class="title">@lang('messages.collaboration')</h3>
                                <p class="description">
                                    @lang('messages.collabration_details')
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                        
                            <span class="year"> <x-heroicon-o-document-arrow-down class="  align-items-center" style="width:70%; height:70%; margin-top:12px !important; margin-left:6px !important; "/></span>
                            <div class="inner-content">
                                <h3 class="title">@lang('messages.property_addition')</h3>
                                <p class="description">
                                    @lang('messages.property_addition_description')
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content text-decoration-none">
                            <span class="year"><x-heroicon-o-magnifying-glass class="  align-items-center" style="width:70%; height:70%; margin-top:12px !important; margin-left:6px !important; "/></span>
                            <div class="inner-content">
                                <h3 class="title">@lang('messages.data_evaluation')</h3>
                                <p class="description text-decoration-none">
                                    @lang('messages.data_evaluation_description')
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year"><x-heroicon-o-building-office-2 class="  align-items-center" style="width:70%; height:70%; margin-top:12px !important; margin-left:6px !important; "/></span>
                            <div class="inner-content">
                                <h3 class="title">@lang('messages.deal_completion')</h3>
                                <p class="description">
                               @lang('messages.deal_completion_description')
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>