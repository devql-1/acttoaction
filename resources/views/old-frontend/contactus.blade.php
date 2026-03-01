 @extends('frontend.layout.app')
@section('content')
  
  
      <!-- Page Banner -->
        <div class="page-banner-area">
            <div class="container">
                <div
                    class="page-banner-inner-area text-center position-relative z-1"
                    style="background-image: url(webtheme/assets/images/page-banner-bg.webp);"
                >
                    <h2 class="text-uppercase text-white text_animation">
                        Contact Us
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Contact Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Contact Info -->
        <div class="contact-info-area pt-150">
            <div class="container">
                <div class="contact-info-inner-area">
                    <div class="row justify-content-center justify-content-lg-between">
                        <div class="col">
                            <div class="contact-info-box d-flex justify-content-lg-center align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div>
                                    <h3 class="text-uppercase">
                                        Address :
                                    </h3>
                                    <p>
                                        {{ $contactInfo->address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="contact-info-box d-flex justify-content-lg-center align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div>
                                    <h3 class="text-uppercase">
                                        Phone :
                                    </h3>
                                    <p>
                                        {{ $contactInfo->phone }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="contact-info-box d-flex justify-content-lg-center align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="ri-mail-ai-line"></i>
                                </div>
                                <div>
                                    <h3 class="text-uppercase">
                                        Email :
                                    </h3>
                                    <p>
                                        {{ $contactInfo->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Info -->
        
        <!-- Contact Us -->
        <div class="contact-area ptb-150">
            <div class="container">
                <form class="  ajaxForms contact-box style-two"  action="{{ route('home.contactus.store') }}" method="POST">
                    @csrf
                    <div class="row g-0 align-items-end">
                        <div class="col-lg-8">
                            <div class="contact-form">
                                <h3 class="text-uppercase text_animation">
                                    Get In Touch
                                </h3>
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" class="form-control shadow-none rounded-0" placeholder="Your name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="email" class="form-control shadow-none rounded-0" placeholder="Your email">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="mobile" class="form-control shadow-none rounded-0" placeholder="Your number">
                                        <span class="text-danger error-text mobile_error"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="subject" class="form-control shadow-none rounded-0" placeholder="Your area">
                                        <span class="text-danger error-text subject_error"></span>
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea  name="message" class="form-control shadow-none rounded-0" placeholder="How can we help you?"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="agree-with-privacy-policy d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="agreeWithPrivacyPolicy">
                                                <label class="form-check-label" for="agreeWithPrivacyPolicy">
                                                    I agree to the privacy policy and give my permission to process my personal data for the purposes specified in the Privacy Policy.
                                                </label>
                                            </div>
                                            <div class="bg-card"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             <div class="form-group">
                                    <div id="successMsg" class="alert alert-success d-none mt-2"></div>
                                </div>

                        <div class="col-lg-4">
                            <div class="contact-form-button">
                                <button type="submit" class="primary-btn text-start d-block w-100 fw-medium text-uppercase">
                                    <span class="d-block position-relative">
                                        Leave a message
                                        <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Contact Us -->

        <!-- Maps -->
        <div class="maps-area pb-150">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32898.82299241542!2d-119.45982750950351!3d36.769577964482934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80945e2140000001%3A0x4025552a3e9b2bae!2sAvocado%20Lake%20Park!5e0!3m2!1sen!2sbd!4v1753808319967!5m2!1sen!2sbd" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- End Maps -->



@endsection