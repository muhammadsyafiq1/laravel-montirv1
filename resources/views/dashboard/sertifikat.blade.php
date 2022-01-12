@extends('layouts.backend')

@section('title')
	Sertifikat
@stop

@section('content')
<div class="container-fluid">
	<div class="row d-flex justify-content-between">
		<button type="button" class="btn  btn-dark text-warning" data-toggle="modal" data-target="#exampleModal" >
			<div>
				<span style="font-weight: bold;">+ Sertifikat</span>			
			</div>
		</button>
		<div >
			<form action="{{route('sertifikat.index')}}" class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search by title" aria-label="Search" name="keyword">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		</div>
	</div>
	@if(session('status'))
	<div class="row p-1">
		<div class="col-12 text-center">
			<div class="alert alert-success">
				{{session('status')}}
			</div>
		</div>
	</div>
	@endif
	<div class="row" style="margin-top: 45px;">
		@forelse($sf as $sertifikat)
			<div class="col-sm-12 col-md-3 col-lg-4 mb-4">
				<div class="card shadow" style="width: 18rem;">
				  <img class="card-img-left" src="{{Storage::url($sertifikat->foto)}}" alt="Card image cap">
				  <div class="card-body">
				    <h6 class="card-text text-uppercase">{{$sertifikat->title}}</h6> 
					<p class="card-text">{{$sertifikat->tujuan_sertifikat}}</p>
					<small class="card-text">{{$sertifikat->keterangan}}</small>
				    <div class="d-flex justify-content-between mt-2">
				    	<div>
				    		<form action="{{route('sertifikat.destroy',$sertifikat->id)}}" method="post">
				    			@csrf @method('delete')
				    			<button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">
				    				<i class="fa fa-trash"></i> Hapus
				    			</button>
				    		</form>
				    	</div>
				    	<div>
				    		<a href="{{route('sertifikat.edit',$sertifikat->id)}}" class="btn btn-sm btn-warning">
				    			<i class="fa fa-edit"></i> Edit
				    		</a>
				    	</div>
				    </div>
				  </div>
				</div>
			</div>
		@empty
			<div class="row text-center">
				<div class="col-12 text-center">
					<span style="font-weight: bold;">Data Tidak Tersedia !</span> &nbsp; <a href="{{route('sertifikat.index')}}"> Lihat Semua Data</a>
				</div>
			</div>
		@endforelse
	</div>
	<div class="row">
		<div class="col-12 text-center">
			{{$sf->links()}}
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah sertifikat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('sertifikat.store')}}" method="post" enctype="multipart/form-data">
        	@csrf
		  <div class="form-group">
		    <label for="foto">Foto Doc sertifikat</label>
		    <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto">
			@error('foto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
		  </div>
		  <div class="form-group">
		    <label for="foto">Keterangan sertifikat</label>
		  	<textarea name="keterangan" cols="10" rows="5" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
			  @error('keterangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
		  </div>
		  <button type="submit" class="btn btn-dark text-warning float-right">Simpan</button>
		</form>
      </div>
    </div>
  </div>
</div>
@stop