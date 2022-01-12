@extends('layouts.backend')

@section('title')
    Pengguna Nonaktif
@stop

@section('content')
  <div class="container-fluid">


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

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pengguna Nonaktif</a>
        </li>
    </ul>
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow mb-4 mt-2 ">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Role</th>
                                <th>Bergabung</th>
                                <th>Dinonaktifkan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        {{$user->email}} <br>
                                        {{$user->no_hp}}
                                    </td>
                                    <td>{{$user->role}}</td>
                                    <td>{{date('D-m-y',strtotime($user->created_at))}}</td>
                                    <td>{{date('D-m-y',strtotime($user->deleted_at))}}</td>
                                    <td>
                                        <a href="{{route('user.restore',$user->id)}}" class="btn btn-sm btn-success" onclick="return confirm('Are You Sure ?')">
                                            <i class="fa fa-check"></i> Active
                                        </a>
                                        <a href="{{route('user.delete',$user->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure ?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@stop

