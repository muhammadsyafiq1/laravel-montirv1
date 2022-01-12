@extends('layouts.backend')

@section('title')
	Dashboard
@stop

@section('content')
<div class="row">

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Pengguna terdaftar</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPengguna}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Annual) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Jumlah montir</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$montirAktif}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-wrench fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pekerjaan selesai
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$pekerjaanSelesai}}</div>
							</div>
							<div class="col">
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
							Customer</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPengguna}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(Auth::user()->accept_by_admin == 3)
	@if(Auth::user()->role == 'montir')
	<div class="row">
		<div class="col-12">
			<ul class="text-danger">
				<li class="text-danger">{{$tolakMontir->alasan_penolakan ?? ''}}</li>
			</ul> 

			 @if(session('status'))
		    	<div class="row">
			    	<div class="col-12">
			    		<div class="alert alert-success">
			    			{{session('status')}}
			    		</div>
			    	</div>
			    </div>
		    @endif

			<a href="{{route('montir.ajukan-montir',Auth::user()->id)}}" class="btn btn-sm btn-info mx-3 my-3" onClick="return confirm('Harap tambahkan sertifikat dan portfolio agar menjadi bahan pertimbangan.')" >
				Ajukan Kembali
			</a>
		</div>
	</div>
	@endif
@endif

@if(Auth::user()->role == 'admin')
<div class="row mt-4">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-dark">
				<div class="card-title text-warning">
					<marquee behavior="" direction="" class="h5">Informasi booking montir terbaru.</marquee>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Nama montir</th>
								<th>Nama customer</th>
								<th>Jenis rusak</th>
								<th>Keterangan</th>
								<th>Diselesaikan</th>
							</tr>
						</thead>
						<tbody>
							@foreach($lastTransaction as $data)
							<tr>
								<td>{{$data->montir->name ?? "data not found"}}</td>
								<td>{{$data->user->name}}</td>
								<td>{{$data->jenis_kerusakan}}</td>
								<td>{{$data->keterangan}}</td>
								<td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at ?? 'not found'))->diffForHumans()}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@stop