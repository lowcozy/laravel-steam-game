@extends('layout.blank')

@push('styles')
    <link href="{{ asset('plugins/ytplayer/jquery.mb.YTPlayer.min.css') }}" rel="stylesheet">
@endpush

@section('title', __('Login'))

@section('content')
    <!-- main -->
    <section class="bg-image player p-y-70" style="background-image: url('https://img.youtube.com/vi/1GWRDuL04-Q/maxresdefault.jpg');" data-property="{videoURL:'1GWRDuL04-Q',containment:'self', stopMovieOnBlur:false, showControls: false, realfullscreen: true, showYTLogo: false, quality: 'highres',autoPlay:true,loop:true,opacity:1}">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card m-b-0">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-sign-in"></i> Login to your account</h4>
                        </div>
                        <div class="card-block">
                            <form action="profile.html">
                                <a class="btn btn-social btn-facebook btn-block btn-icon-left" href="" role="button"><i class="fa fa-facebook"></i> Connect with Facebook</a>
                                <div class="divider">
                                    <span>or</span>
                                </div>
                                <div class="form-group input-icon-left m-b-10">
                                    <i class="fa fa-user"></i>
                                    <input type="email" class="form-control form-control-secondary" placeholder="Username">
                                </div>
                                <div class="form-group input-icon-left m-b-15">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="form-control form-control-secondary" placeholder="Password">
                                </div>
                                <label class="custom-control custom-checkbox custom-checkbox-primary">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Remember me</span>
                                </label>
                                <button type="submit" class="btn btn-primary btn-block m-t-10">Login <i class="fa fa-sign-in"></i></button>
                                <div class="divider">
                                    <span>Don't have an account?</span>
                                </div>
                                <a class="btn btn-secondary btn-block" href="register.html" role="button">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->
@endsection

@push('js')
    <script src="{{ asset('plugins/ytplayer/jquery.mb.YTPlayer.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(".player").mb_YTPlayer();
        })(jQuery);
    </script>
@endpush