@extends('frontend.frontend_master')
@section('title')
    SIAC || Contact
@endsection
@section('frontend_content')
    <!-- breadcrumb start -->
    <div class="breadcrumb__area" style="background-image: url({{ asset('frontend') }}/assets/image/contact.jpg);">
        <h2>contact</h2>
    </div>
    <!-- breadcrumb end -->

    <!-- contact start -->
    <div class="contact__area section__padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58885.83515672656!2d89.02897356120647!3d22.714682249749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff5dd8cc387413%3A0xf05c8c2849c76277!2sSatkhira!5e0!3m2!1sen!2sbd!4v1716605265187!5m2!1sen!2sbd"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-7">
                    <div class="contact__form">
                        <form action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Name"
                                            value="{{ auth()->check() ? auth()->user()->name : old('name') }}">
                                        @error('name')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control"
                                            placeholder="Subject" value="{{ old('subject') }}">
                                        @error('subject')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Email"
                                            value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                                        @error('email')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            placeholder="Phone"
                                            value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control" cols="30" rows="5">{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact end -->
@endsection
