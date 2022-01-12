@extends('layouts.backend')

@section('title')
    Beri review montir
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
    <div class="card shadow mb-4 mt-2 mb-3 ">
        <div class="card-header bg-dark">
            <div class="card-title text-warning h5">
                Review montir
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama montir</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($review as $r)
                            <tr>
                                <td>{{$r->montir->name ?? ''}}</td>
  
                                <td>
                                    @if($r->review == '')
                                    <a href="javascript:void()"
                                        data-id="{{$r->id}}"
                                        data-montir_id="{{$r->montir->id}}"
                                        data-rating_id="{{$r->rating->id}}"
                                        data-name= "{{$r->montir->name ??"data not found"}}"
                                        type="button"
                                        class="btn btn-sm  btn-warning button-update"
                                        >
                                        Berikan review dan rating
                                    </a>
                                    @else
                                       <span class="text-success"> Terimakasih Telah Memberi Review </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <div class="card shadow mb-4 mt-2 mb-3 ">
        <div class="card-header bg-dark">
            <div class="card-title text-warning h5">
                Rating montir
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_rating" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama montir</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rating as $rating)
                            <tr>
                                <td>{{$rating->montir->name ?? ''}}</td>
                                <td>{{$rating->montir->no_hp ?? ''}}</td>
                                <td>
                                    @if($rating->stars_rated == 0)
                                    <a href="javascript:void()"
                                        data-user="{{$rating->user->id}}"
                                        data-rating_id="{{$rating->id}}"
                                        data-montir="{{$rating->montir->id ??"data not found"}}"
                                        type="button"
                                        class="btn btn-sm  btn-primary button-rating"
                                        >
                                    Berikan Rating
                                    </a>
                                    @else
                                        Terimakasih telah memberi rating <span class="fa fa-star" style="color: #ffd900;"> </span> {{$rating->stars_rated}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <div class="card shadow mb-4 mt-2 mb-3 ">
        <div class="card-header bg-dark">
            <div class="card-title text-warning h5">
                Complain montir
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_complain" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama montir</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complain as $complain)
                            <tr>
                                <td>{{$complain->montir->name ?? ''}}</td>
                                
                                <td>
                                    @if($complain->complain == '')
                                    <a href="javascript:void()"
                                        data-id="{{$complain->id}}"
                                        data-montir="{{$complain->montir->id}}"
                                        data-user="{{$complain->user->id}}"
                                        data-name= "{{$complain->montir->name ??"data not found"}}"
                                        type="button"
                                        class="btn btn-sm  btn-warning button-complain"
                                        >
                                        Berikan Masukan
                                    </a>
                                    @else
                                       <span class="text-success"> Terimakasih Telah Memberi Masukan </span>
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


  <!-- Modal review -->
  <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Berikan review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('test')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama montir</label>
                    <input type="text" name="name" id="name" class="form-control name" readonly>
                    <input type="hidden" name="rating_id" id="rating_id" class="form-control rating_id" readonly>
                    <input type="hidden" name="montir_id" id="montir_id" class="form-control montir_id" readonly>
                </div>
                <div class="rating-css">
                    <div class="star-icon">
                        <input type="radio" name="stars_rated" value="1" checked id="rating1">
                        <label for="rating1" class="fa fa-star" ></label>
                        <input type="radio" name="stars_rated" value="2" id="rating2">
                        <label for="rating2" class="fa fa-star" ></label>
                        <input type="radio" name="stars_rated" value="3" id="rating3">
                        <label for="rating3" class="fa fa-star" ></label>
                        <input type="radio" name="stars_rated" value="4" id="rating4">
                        <label for="rating4" class="fa fa-star" ></label>
                        <input type="radio" name="stars_rated" value="5 " id="rating5">
                        <label for="rating5" class="fa fa-star" ></label>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name">Review</label>
                    <textarea name="review" id="3" cols="2" rows="2" class="form-control"> </textarea>
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
  <!-- modal rating -->
 <!-- <div class="modal fade" id="modalRating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Beri rating montir </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('rating.store')}}" method="post">
            <input type="hidden" name="montir_id" id="montir_id" class="form-control montir" required>
            <div class="form-group">
                <input type="hidden" name="rating_id" id="rating_id" class="form-control rating_id" required>
            </div>
              @csrf
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
          </form>
        </div>
      </div>
    </div> -->

<!-- Modal komplain -->
  <div class="modal fade" id="complain-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat komplain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('complain.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" class="form-control id" required>
                </div>
                 <div class="form-group">
                    <input type="hidden" name="user_id" id="user" class="form-control user" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="montir_id" id="montir" class="form-control montir" required>
                </div>
                <div class="form-group">
                    <label for="complain">Komplain</label>
                    <textarea class="form-control" rows="3" cols="3" name="complain"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- star css -->
<style>
        .rating-css div {
            color: #ffe400;
            font-size: 30px;
            font-family: sans-serif;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            padding: 20px 0;
        }
        .rating-css input {
            display: none;
        }
        .rating-css input + label {
            font-size: 50px;
            text-shadow: 1px 1px 0 #8f8420;
            cursor: pointer;
        }
        .rating-css input:checked + label ~ label {
            color: #b4afaf;
        }
        .rating-css label:active{
            transform: scale(0.8);
            transition: 0.3s ease;
        }
        .checked{
          color: #ffd900;
        }
    </style>
    <!-- end star css -->

@stop

@push('scripts')
    <script>
        $('#table_id').on('click','.button-update', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let review = $(this).data('review');
            let rating_id = $(this).data('rating_id');
            let montir_id = $(this).data('montir_id');

            $('#edit-modal').modal('show');
            $('.name').val(name);
            $('.id').val(id);
            $('.rating_id').val(rating_id);
            $('.montir_id').val(montir_id);
            $('.review').val(review);
        })
    </script>

    <script>
        $('#table_complain').on('click','.button-complain', function(){
            let id = $(this).data('id');
            let user = $(this).data('user');
            let montir = $(this).data('montir');
            let complain_id = $(this).data('complain_id');
            $('#complain-modal').modal('show');
            $('.id').val(id);
            $('.user').val(user);
            $('.montir').val(montir);
            $('.complain_id').val(complain_id);
        })
    </script>

    <script>
        $('#table_rating').on('click','.button-rating', function(){
            let id = $(this).data('id');
            let user = $(this).data('user');
            let montir = $(this).data('montir');
            let rating_id = $(this).data('rating_id');
            $('#modalRating').modal('show');
            $('.id').val(id);
            $('.user').val(user);
            $('.montir').val(montir);
            $('.rating_id').val(rating_id);

        })
    </script>
@endpush

