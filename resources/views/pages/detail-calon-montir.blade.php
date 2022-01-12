@extends('layouts.backend')

@section('title')
    {{$user->name}}
@stop

@section('content')
    <div class="container-flud">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Detail sertiikat & portfolio - {{$user->name}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-3 mt-1">Sertifikat</h5> 
                            </div>
                            <div class="col-6">
                                <h5 class="mb-3 mt-1">Portfolio</h5>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @foreach($user->sertifikat as $sertifikat)
                                    <div class="col-sm-12 col-md-3 col-lg-4 mb-4">
                                        <div class="card shadow" style="width: 18rem;">
                                          <img class="card-img-left" src="{{Storage::url($sertifikat->foto)}}" alt="Card image cap" style="height: 300px;">
                                          <div class="card-body">
                                            <h6 class="card-text text-uppercase">{{$sertifikat->title}}</h6> 
                                            <p class="card-text">{{$sertifikat->tujuan_sertifikat}}</p>
                                            <small class="card-text">{{$sertifikat->keterangan}}</small>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-6">
                                @foreach($user->portfolio as $portfolio)
                                    <div class="col-sm-12 col-md-3 col-lg-4 mb-4">
                                        <div class="card shadow" style="width: 18rem;">
                                          <img class="card-img-left" src="{{Storage::url($portfolio->foto)}}" alt="Card image cap" style="height: 300px">
                                          <div class="card-body">
                                            <p class="card-text">{{$portfolio->keterangan}}</p>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- back -->
                    <a style="margin-bottom: 50px;" href="{{route('user.index')}}" class="btn btn-sm btn-warning btn block">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

