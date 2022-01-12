@extends('layouts.backend')

@section('title')
    Pesanan saya
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

      
      <!-- Tab panes -->
    <ul class="text-danger">
        @if(Auth::user()->role == 'customer')
            @foreach($tolakCustomer as $ts)
                <li class="text-info"> 
                    Pesanan anda untuk montir ditolak {{$ts->montir->name}} - "{{$ts->alasan_penolakan ?? ''}}" 
                    <a href="{{route('hapus-info',$ts->id)}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </li>
            @endforeach
        @else
            @foreach($tolakCustomer as $ts)
                <li class="text-info"> 
                    Pesanan anda untuk montir ditolak {{$ts->user->name}} - "{{$ts->alasan_penolakan ?? ''}}" 
                    <a href="{{route('hapus-info',$ts->id)}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </li>
            @endforeach
        @endif
        
	</ul> 
    <div class="card shadow mb-4 mt-2 ">
        <div class="card-header bg-dark">
            <div class="card-title text-warning">
                Tabel Pesanan Montir - {{Auth::user()->name}}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama montir</th>
                            <th>Jenis kerusakan</th>
                            <th>Status pesanan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            
                            <tr>
                                <td>{{$d->montir->name ??"data not found"}}</td>
                                <td>{{$d->jenis_kerusakan}}</td>
                                @if($d->status == 'diterima')
                                    <td class="text-success">Telah diterima dan sedang dikerjakan</td>
                                @elseif($d->status == 'ditolak')
                                    <td class="text-warning"> <i class="fa fa-times"></i> </td>
                                @elseif($d->status == 'selesai')
                                    <td class="text-primary">{{$d->status}}</td>
                                @elseif($d->status == 'proses')
                                <td class="text-info">{{$d->status}}</td>
                                @elseif($d->status == 'menunggu')  
                                <td class="text-warning">Sedang menunggu montir</td>
                                @endif    
                                <td>
                                    
                                    @if($d->status == 'diterima')
                                        <a href="{{url('booking-selesai',[$d->montir->id, $d->id])}}" class="btn btn-sm btn-info "> Pekerjaan selesai</a>
                                    @endif
                                    @if($d->status == 'proses')
                                        Pesanan anda sedang menunggu montir
                                    @endif
                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
@stop



