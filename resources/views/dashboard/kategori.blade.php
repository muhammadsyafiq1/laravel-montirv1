@extends('layouts.backend')

@section('title')
    Kategori
@stop

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4"> <i class="fa fa-warning text-warning"></i> Kamu dapat menambahkan kategori montir dibawah ini.</p>

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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	<button type="button" class="btn btn-dark text-warning" data-toggle="modal" data-target="#exampleModal">
				  <span style="font-weight: bold;">+ Kategori</span>
				</button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Icon Kategori</th>
                            <th>Ditanbahkan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($categories as $category)
                    		<tr>
	                    		<td>{{$category->nama_category}}</td>
	                    		<td>
	                    			<img src="{{Storage::url($category->foto)}}" alt="{{$category->nama_kategori}}" style="width: 100px;">
	                    		</td>
	                    		<td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($category->created_at))->diffForHumans()}}</td>
	                    		<td>
	                    			<form method="post" action="{{route('kategori.destroy',$category->id)}}" class="d-inline">
	                    				@csrf @method('delete')
	                    				<a href="{{route('kategori.edit',$category->id)}}" class="btn btn-sm btn-warning">
	                    					<i class="fa fa-edit"></i>
	                    				</a>
	                    				<button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">
	                    					<i class="fa fa-trash"></i>
	                    				</button>
	                    			</form>
	                    		</td>
	                    	</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('kategori.store')}}" method="post" enctype="multipart/form-data">
        @csrf
		  <div class="row">
		    <div class="col-12">
		      <input type="text" name="nama_category" class="form-control @error('nama_category') is-invalid @enderror" placeholder="Nama Katgeori">
		       	@error('nama_category')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
		    </div>
		    <div class="col-12">
		      <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
		      	@error('foto')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
		    </div>
		  </div>
		  	<div class="float-right pt-5"> 
		  		<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        		<button type="submit" class="btn btn-dark text-warning">Simpan</button>
		  	</div>
		</form>
      </div>
    </div>
  </div>
</div>
@stop

