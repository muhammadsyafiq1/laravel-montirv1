@extends('layouts.backend')

@section('title')
    Edit Sertifikat
@stop

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    
    <p class="mb-4"> <i class="fa fa-warning text-warning"></i> Edit ID sertifikat Montir - {{$sf->id}}. <img src="{{Storage::url($sf->foto)}}" style="width: 50px;"></p> 

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
             <form action="{{route('sertifikat.update',$sf->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
              <div class="form-group">
                <label for="foto">Foto Doc sertifikat</label>
                <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto">
              </div>
              <div class="form-group">
                <label for="foto">Keterangan sertifikat</label>
                <textarea name="keterangan" cols="10" rows="5" class="form-control @error('keterangan') is-invalid @enderror">{{$sf->keterangan}}</textarea>
              </div>
              <button type="submit" class="btn btn-dark text-warning float-right">Simpan</button>
            </form>
        </div>
    </div>
</div>

@stop

