@extends('layouts.backend')

@section('title')
    Booking masuk
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
    <div class="card shadow mb-4 mt-2 ">
        <div class="card-header bg-dark">
            <div class="card-title text-warning">
                Booking Masuk - {{Auth::user()->name}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama pemesan</th>
                            <th>Kontak</th>
                            <th>Jenis kerusakan</th>
                            <th>Lama rusak</th>
                            <th>Status</th>
                            <th>Booking Masuk</th>
                            <th>Tanggal Penjemputan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$d->user->name ?? 'not found'}}</td>
                                <td>{{$d->user->no_hp ?? 'not found'}}</td>
                                <td>{{$d->jenis_kerusakan ?? 'not found'}}</td>
                                <td>{{$d->berapa_lama_kerusakan ?? 'not found'}}</td>
                                @if($d->status == 'diterima')
                                    <td class="text-success">Sedang dikerjakan</td>
                                @elseif($d->status == 'ditolak')
                                    <td class="text-danger"> <i class="fa fa-times"></i> </td>
                                @else
                                    <td class="text-warning">{{$d->status}}</td>
                                @endif
                                <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($d->created_at ?? 'not found'))->diffForHumans()}}</td>
                                <td>{{$d->jadwal_penjemputan}}</td>
                                <td>
                                    @if( $d->status == 'menunggu')
                                        <div>
                                            <a onClick="return confirm('Terima pesanan dari {{$d->user->name ?? 'not found'}} ')" href="{{route('booking.diterima', $d->id)}}" class="btn btn-sm btn-circle btn-success"> <i class="fa fa-check"></i> </a>
                                            <!-- <a onClick="return confirm('Tolak pesanan dari {{$d->user->name ?? 'not found'}} ')" href="{{route('booking.ditolak', $d->id)}}" class="btn btn-sm btn-danger btn-circle"> <i class="fa fa-times"></i></a>    -->
                                            <a href="javascript:void()"
                                                data-id="{{$d->id}}"
                                                data-customer= "{{$d->user->name}}"
                                                data-customer_id= "{{$d->user->id}}"
                                                data-booking_id= "{{$d->id}}"
                                                type="button"
                                                class="btn btn-sm  btn-danger button-tolak btn-circle"
                                                >
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>                                   
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

<!-- modal tolak -->
<div class="modal fade" id="tolak-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Berikan alasan penolakan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('booking.ditolak')}}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="customer_id" id="montir" class="form-control customer_id">
            <input type="hidden" name="booking_id" id="montir" class="form-control booking_id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama customer</label>
                    <input type="text" name="name" id="name" class="form-control customer" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Alasan penolakan</label>
                    <textarea name="alasan_penolakan" id="3" cols="2" rows="2" class="form-control"> </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- end modal tolak -->
@stop

@push('scripts')
    <script>
        $('#table_id').on('click','.button-tolak', function(){
            let id = $(this).data('id');
            let customer = $(this).data('customer');
            let customer_id = $(this).data('customer_id');
            let booking_id = $(this).data('booking_id');

            $('#tolak-modal').modal('show');
            $('.customer').val(customer);
            $('.customer_id').val(customer_id);
            $('.booking_id').val(booking_id);
        })
    </script>
@endpush

