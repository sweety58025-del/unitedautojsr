@extends('frontend.partials.master')
@section('title', 'Contact Us')
@section('meta_description', 'Contact United Auto in Jamshedpur for expert car servicing, detailing, and repair support from our trusted workshop team.')
@section('og_title', 'Contact United Auto | Car Service in Jamshedpur')
@section('content')
@include('frontend.partials.breadcumbs')

<section class="pd-bottom-300">
    <div class="container">
        <div class="wptb-office-address mr-bottom-90">
            <div class="row">

                <!-- Phone -->
                <div class="col-md-4 pe-md-0">
                    <div class="widget">

                        <h2 class="widget-title">Phone No</h2>

                        <div class="wptb-office">
                            <div class="wptb-item--inner">

                                <div class="wptb-item--subtitle">
                                    Call Us Anytime
                                </div>

                                <h5 class="wptb-item--title">
                                    <a href="tel:{{ $contact_us->phone }}">
                                        {{ $contact_us->phone }}
                                    </a>
                                </h5>

                            </div>
                        </div>

                    </div>
                </div>


                <!-- Email -->
                <div class="col-md-4 p-md-0">
                    <div class="widget">

                        <h2 class="widget-title">Email</h2>

                        <div class="wptb-office">
                            <div class="wptb-item--inner">

                                <div class="wptb-item--subtitle">
                                    SEND US MAIL
                                </div>

                                <h5 class="wptb-item--title">
                                    <a href="mailto:{{ $contact_us->email }}">
                                        {{ $contact_us->email }}
                                    </a>
                                </h5>

                            </div>
                        </div>

                    </div>
                </div>


                <!-- Address -->
                <div class="col-md-4 ps-md-0">
                    <div class="widget">

                        <h2 class="widget-title">Address</h2>

                        <div class="wptb-office">
                            <div class="wptb-item--inner">

                                <div class="wptb-item--subtitle">
                                    VISIT OUR WORKSHOP
                                </div>

                                <h5 class="wptb-item--title">
                                    <a href="#">

                                        {{ $contact_us->address }},
                                        {{ $contact_us->city }},
                                        {{ $contact_us->state }} -
                                        {{ $contact_us->pincode }}

                                    </a>
                                </h5>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="wptb-contact-form-two mr-top-100">
            <div class="wptb-form--wrapper">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner">
                                <h6 class="wptb-item--subtitle">
                                    SEND US MAIL
                                </h6>
                                <h1 class="wptb-item--title"> Feel Free To Ask Anything
                                    For Car Servicing</h1>
                                <div class="wptb-item--divider"></div>
                                <div class="wptb-item--description">
                                    Have questions about your car servicing? Our expert team is ready to help. Contact us anytime for reliable advice, quick support, and professional car maintenance services to keep your vehicle running smoothly.

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6">
                        <form class="wptb-form" action="contact.php" method="post">
                            <div class="wptb-form--inner">        
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name*" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="E-mail*" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 mb-4">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Text"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <div class="wptb-item--button"> 
                                            <button class="btn-two white" type="submit">
                                                <div class="btn-wrap">
                                                    <span class="text-first"> Send Mail </span> 
                                                    <span class="text-second"> <i class="bi bi-plus"></i> </span> 
                                                </div> 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>					
    </div>
</section>

<br><br><br><br>
@endsection