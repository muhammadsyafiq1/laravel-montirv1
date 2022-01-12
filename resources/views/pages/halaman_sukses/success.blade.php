@extends('layouts.app')

@section('title')
    Booking Montir Sukses
@stop

@section('content')
<!--BISMILLAHI-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Success Belanja</title>

  </head>

  <body>

    <div class="page-content page-success" style="margin-top: 120px;">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/montir/img/success.svg" class="mb-4">
                        <h2>
                            Booking Montir Sukses
                        </h2>
                        <p>
                            Silahkan tunggu konfirmasi dari montir - <span style="font-weight: bold;">{{$user->name}}</span> dan
                            cek secara berkala status bookingmu!
                        </p>  
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-success w-50 mt-4">
                                My Dashbord
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-secondary w-50 mt-2" style="margin-bottom: 70px;">
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>

@endsection