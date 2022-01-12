@extends('layouts.backend')

@section('title')
	Portfolio
@stop

@section('content')
<div class="container-fluid">
	<div class="row d-flex justify-content-between">
		<button type="button" class="btn  btn-dark text-warning" data-toggle="modal" data-target="#exampleModal" >
			<div>
				<span style="font-weight: bold;">+ Portfolio</span>			
			</div>
		</button>
		<div >
			<form action="{{route('portfolio.index')}}" class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search by keterangan" aria-label="Search" name="keyword">
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
		@forelse($portfolios as $portfolio)
			<div class="col-sm-12 col-md-3 col-lg-4 mb-4">
				<div class="card shadow" style="width: 18rem;">
				  <img class="card-img-left" src="{{Storage::url($portfolio->foto)}}" alt="Card image cap">
				  <div class="card-body">
				    <p class="card-text">{{$portfolio->keterangan}}</p> 
				    <div class="d-flex justify-content-between">
				    	<div>
				    		<form action="{{route('portfolio.destroy',$portfolio->id)}}" method="post">
				    			@csrf @method('delete')
				    			<button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">
				    				<i class="fa fa-trash"></i> Hapus
				    			</button>
				    		</form>
				    	</div>
				    	<div>
				    		<a href="{{route('portfolio.edit',$portfolio->id)}}" class="btn btn-sm btn-warning">
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
					<span style="font-weight: bold;">Data Tidak Tersedia !</span> &nbsp; <a href="{{route('portfolio.index')}}"> Lihat Semua Data</a>
				</div>
			</div>
		@endforelse
	</div>
	<div class="row">
		<div class="col-12 text-center">
			{{$portfolios->links()}}
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Portfolio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('portfolio.store')}}" method="post" enctype="multipart/form-data">
        	@csrf
		  <div class="form-group">
		    <label for="foto">Foto Doc Portfolio</label>
		    <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto">
		  </div>
		  <div class="form-group">
		    <label for="foto">Keterangan Portfolio</label>
		  	<textarea name="keterangan" cols="10" rows="5" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
		  </div>
		  <button type="submit" class="btn btn-dark text-warning float-right">Simpan</button>
		</form>
      </div>
    </div>
  </div>
</div>
@stop