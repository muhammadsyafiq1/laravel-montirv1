@extends('layouts.backend')

@section('title')
    Data Komplain
@stop

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4"> <i class="fa fa-warning text-warning"></i> Semua data komplain dari customer anda.</p>

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
            <div class="table-responsive">
                <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Nama Montir</th>
                            <th>Komplain</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($complains as $complain)
                    		<tr>
                                <td>{{$complain->user->name}}</td>  
                                <td>{{$complain->montir->name}}</td>  
                                <td>{{$complain->complain}}</td>  
                            </tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@stop

