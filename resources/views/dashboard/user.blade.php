@extends('layouts.backend')

@section('title')
    Pengguna Aktif
@stop

@section('content')
  <div class="container-flud">


    @if(session('status'))
    	<div class="row">
	    	<div class="col-12">
	    		<div class="alert alert-success">
	    			{{session('status')}}
	    		</div>
	    	</div>
	    </div>
    @endif 
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-active-tab" data-toggle="tab" href="#nav-active" role="tab" aria-controls="nav-active" aria-selected="true">Pengguna</a>
              <a class="nav-item nav-link" id="nav-daftar-tab" data-toggle="tab" href="#nav-daftar" role="tab" aria-controls="nav-daftar" aria-selected="false">Montir</a>
            </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4 mt-2">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kontak</th>
                                                    <th>Role</th>
                                                    <th>Bergabung</th>
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
                                                        <td>
                                                            <a onclick="return confirm('{{$user->name}} Akan Dinonaktifkan ?')" href="{{route('trash',$user->id)}}" class="btn btn-sm btn-danger btn-circle" onclick="return confirm('Are You Sure ?')">
                                                                <i class="fa fa-trash"></i> 
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
                <div class="tab-pane fade" id="nav-daftar" role="tabpanel" aria-labelledby="nav-daftar-tab">
                    <div class="card shadow mb-4 mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <td>Alamat</td>
                                            <td>Pekerjaan</td>
                                            <td>Bengkel</td>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calon_montir as $cm)
                                            <!-- @if($cm->role != 'admin') -->
                                            <tr>
                                                <td>
                                                    <img src="{{Storage::url($cm->foto)}}" style="width: 80px">
                                                </td>
                                                <td>{{$cm->name}}</td>
                                                <td>
                                                    {{$cm->email}} 
                                                </td>
                                                <td>{{$cm->alamat}}</td>
                                                <td>{{$cm->pekerjaan}}</td>
                                                <td>{{$cm->nama_bengkel ?? 'Tidak ada'}}</td>
                                                <td>
                                                    @if ($cm->accept_by_admin == 0)
                                                        <i class="text-danger" >Montir Belum Aktif</i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('user.detail-montir',$cm->id)}}" class="btn btn-sm  btn-secondary">
                                                        <i class="fa fa-eye"> </i>
                                                    </a>
                                                     <a href="{{ route('user.accepted',$cm->id) }}" class="btn btn-sm  btn-success">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                     <!-- <a href="{{route('montir.tolak',$cm->id)}}" onClick="return confirm('Yakin tolak montir?')" class="btn btn-sm  btn-danger">
                                                        <i class="fa fa-times"> </i>
                                                    </a> -->
                                                    <a href="javascript:void()"
                                                        data-id="{{$cm->id}}"
                                                        data-name= "{{$cm->name ??"data not found"}}"
                                                        data-montir= "{{$cm->id}}"
                                                        type="button"
                                                        class="btn btn-sm  btn-danger button-tolak"
                                                        >
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- @endif -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
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
        <form action="{{route('tolak-daftar-montir')}}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="montir_id" id="montir" class="form-control montir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama montir</label>
                    <input type="text" name="name" id="name" class="form-control name" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Alasan penolakan</label>
                    <textarea name="alasan_penolakan" id="3" cols="2" rows="2" class="form-control"> </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id" >
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- end modal tolak -->
@stop

@push('scripts')
    <script>
        $('#table_id1').on('click','.button-tolak', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let montir = $(this).data('montir');

            $('#tolak-modal').modal('show');
            $('.name').val(name);
            $('.id').val(id);
            $('.montir').val(montir);
        })
    </script>
@endpush

