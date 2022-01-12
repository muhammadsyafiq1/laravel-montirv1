@extends('layouts.backend')

@section('title')
    Edit Kategori
@stop

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4"> <i class="fa fa-warning text-warning"></i> Edit Kategori Montir - {{$category->nama_category}}. <img src="{{Storage::url($category->foto)}}" style="width: 50px;"></p> 

    @if(session('status'))
    	<div class="row">
	    	<div class="col-12">
	    		<div class="alert alert-success">
	    			{{session('status')}}
	    		</div>
	    	</div>
	    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('kategori.update',$category->id)}}" method="post" enctype="multipart/form-data">
            @csrf @method('put')
              <div class="row">
                <div class="col">
                  <input type="text" name="nama_category" class="form-control @error('nama_category') is-invalid @enderror" placeholder="Nama Katgeori" value="{{old('nama_category') ? old('nama_category') : $category->nama_category}}">
                    @error('nama_category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                  <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                  <small><i>Kosongkan Jika Tidak Ingin Merubah Icon.</i></small>
                    @error('foto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                  <input type="text" name="url_icon" class="form-control @error('url_icon') is-invalid @enderror" placeholder="Nama Katgeori" value="{{old('url_icon') ? old('url_icon') : $category->url_icon}}">
                    @error('url_icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
                <div class="float-right pt-5"> 
                    <a href="{{route('kategori.index')}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-dark text-warning">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

