@extends('layouts.backend')

@section('title')
    Kolola Data Saya
@stop

@section('content')
  <div class="container-fluid">

    <!-- flash alert -->
    @if(session('status'))
    	<div class="row">
	    	<div class="col-12">
	    		<div class="alert alert-warning  text-uppercase" style="font-weight:bold;">
	    			{{session('status')}}
	    		</div>
	    	</div>
	    </div>
    @endif
    <!-- foto null -->
    @if($montir->foto == null)
    	<div class="row">
	    	<div class="col-12">
	    		@if(Auth::user()->role == 'montir')
                    <div class="alert alert-warning  text-uppercase" style="font-weight:bold;">
                        ! Harap Memberikan Foto Pada Profil Anda Agar Informasi anda dapat ditampilkan pada <i>website</i>
                    </div>
                @else
                    <div class="alert alert-warning  text-uppercase" style="font-weight:bold;">
                        ! Harap Melengkapi Data Pribadi Anda</i>
                    </div>
                @endauth
	    	</div>
	    </div>
    @endif
    <!-- DataTales Example -->
    @if (Auth::user()->role == 'montir')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="">
                <h6 class="fa fa-wrench"> Selamat Datang <i>{{$montir->name}} -  ID # {{$montir->id}} - <span class="text-success text-uppercase">{{$montir->ketersediaan}}</span></i> </h6> <br>
                @if($montir->ketersediaan == 'tersedia')
                    <a href="{{route('tutup.ketersediaan',$montir->id)}}" class="btn btn-sm btn-dark tex-white" onClick="return confirm('Tutup ketersediaan montir ?')">
                        Closed
                    </a>
                @else
                     <a href="{{route('buka.ketersediaan',$montir->id)}}" class="btn btn-sm btn-dark tex-info" onClick="return confirm('Buka ketersediaan montir ?')">
                        Open
                    </a>
                @endif
            </div>
            <div class="">
            @if (Auth::user()->foto)
            <form action="{{route('user.update',$montir->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <input name="foto" class="@error('foto') is-invalid @enderror" type="file">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img 
                  src="{{Storage::url($montir->foto)}}" 
                  alt="user" 
                  height="40" class="rounded-circle mr-2"
                  />  <br>
                  <small style="margin-top: -50px;">Anda Dapat Merubah Foto Profil Anda.</small>
            @else 
                <form action="{{route('user.update',$montir->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <input name="foto" class="@error('foto') is-invalid @enderror" type="file">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 <img src="https://ui-avatars.com/api/?name={{ $montir->name }}" height="40" class="rounded-circle" />  <br>
                <small style="margin-top: -50px;">Anda Dapat Merubah Foto Profil Anda.</small>
            @endif
            </div>
        </div>
        <div class="card-body">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label for="name">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$montir->name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="email">Email</label>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$montir->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="no_hp">Handphone</label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{$montir->no_hp}}">
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12 col-lg-4">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input class="form-control @error('pekerjaan') is-invalid @enderror" type="text" name="pekerjaan" value="{{$montir->pekerjaan}}">
                        @error('pekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="nama_bengkel">Nama Bengkel / Tempat Kerja</label>
                        <input class="form-control @error('nama_bengkel') is-invalid @enderror" type="text" name="nama_bengkel" value="{{$montir->nama_bengkel}}">
                        @error('nama_bengkel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12 col-lg-6">
                        <label for="alamat">Pengalaman kerja</label>
                        <textarea name="pengalaman" class="form-control @error('pengalaman') is-invalid @enderror">{{$montir->pengalaman}}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label for="tentang">Lingkup wilayah penjemputan</label>
                        <input class="form-control @error('lingkup_wilayah') is-invalid @enderror" type="text" name="lingkup_wilayah" value="{{$montir->lingkup_wilayah}}">
                        @error('tentang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12 col-lg-6">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30" rows="4">{{$montir->alamat}}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label for="tentang">Tentang Saya</label>
                        <textarea class="form-control @error('tentang') is-invalid @enderror" name="tentang" id="tentang" cols="30" rows="4">{{$montir->tentang}}</textarea>
                        @error('tentang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button class="mt-4 text-center text-warning btn btn-sm btn-dark btn-block" type=submit>
                    Simpan
                </button>
            </form>
        </div>
    </div>
    @else
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="">
                <h6 class="fa fa-wrench"> Selamat Datang <i>{{$montir->name}}</i> </h6>
            </div>
            <div class="">
            @if (Auth::user()->foto)
            <form action="{{route('user.update',$montir->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <input name="foto" class="@error('foto') is-invalid @enderror" type="file">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img 
                  src="{{Storage::url($montir->foto)}}" 
                  alt="user" 
                  height="40" class="rounded-circle mr-2"
                  />  <br>
                  <small style="margin-top: -50px;">Anda Dapat Merubah Foto Profil Anda.</small>
            @else 
                <form action="{{route('user.update',$montir->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <input name="foto" class="@error('foto') is-invalid @enderror" type="file">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                 <img src="https://ui-avatars.com/api/?name={{ $montir->name }}" height="40" class="rounded-circle" />  <br>
                <small style="margin-top: -50px;">Anda Dapat Merubah Foto Profil Anda.</small>
            @endif
            </div>
        </div>
        <div class="card-body">
                <div class="row form-group">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label for="name">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$montir->name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="email">Email</label>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$montir->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="no_hp">Handphone</label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{$montir->no_hp}}">
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    {{-- <div class="col-sm-12 col-lg-4">
                        <label for="nama_bengkel">Nama Bengkel / Tempat Kerja</label>
                        <input class="form-control @error('nama_bengkel') is-invalid @enderror" type="text" name="nama_bengkel" value="{{$montir->nama_bengkel}}">
                        @error('nama_bengkel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                </div>
                <div class="row form-group">
                    <div class="col-sm-12 col-lg-6">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30" rows="4">{{$montir->alamat}}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button class="mt-4 text-center text-warning btn btn-sm btn-dark btn-block" type=submit>
                    Simpan
                </button>
            </form>
        </div>
    </div>
    @endif
</div>

@stop

