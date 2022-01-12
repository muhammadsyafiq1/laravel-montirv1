@extends('layouts.app')

@section('title')
	Detail Montir
@stop

@section('content')
      <style>
        .checked{
          color: #ffd900;
        }
      </style>
      <!-- navbar -->
      <!-- end navbar -->
  
      <!-- breadcrumb -->
      <div class="container mt-5">
          <nav >
              <ol class="breadcrumb bg-transparent pl-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$montir->name}} </li>
                <li class="breadcrumb-item active" aria-current="page">{{$montir->ketersediaan}} </li>
              </ol>
            </nav>
      </div>
      <!-- end breadcrumb -->
  
      <!-- single product -->
      <section class="single-product">
          <div class="container">
              <div class="row">
                  <div class="col-lg-5">
                      <figure class="figure">
                          <img src="{{Storage::url($montir->foto)}}" class="figure-img img-fluid shadow" alt="image" width="450px;">
                        </figure>
                  </div>
  
                  <div class="col-6 col-lg-5">
                      <h3>
                        @php 
                          $ratenum = number_format($rating_value);
                        @endphp
                        {{$montir->name}} - 
                        @for($i = 1; $i <= $ratenum; $i++)
                          <i style="font-size: 20px;"  class="fa fa-star checked"></i> 
                        @endfor
                        @for($j = $ratenum+1; $j <= 5; $j++)
                          <i style="font-size: 20px;"  class="fa fa-star"></i>
                        @endfor
                      </h3>
                      <p class="text-muted">Alamat : {{$montir->alamat}}</p>
                      <p class="text-muted">Pengalaman :  {{$montir->pengalaman}}</p>
                      <p class="text-muted">Lingkup penjemputan :  {{$montir->lingkup_wilayah}}</p>
                      <p class="text-muted">Tentang saya :  {{$montir->tentang}}</p>

                      @auth
                        @if($montir->ketersediaan == 'tersedia')
                          @if(Auth::user()->role != 'admin')
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-success btn-block text-center">
                            <i class="fa fa-list text-white"> Booking Montir</i>
                          </button>
                          @else
                            <span class="badge badge-warning">Admin tidak dapat melakukan booking</span>
                          @endif
                        @else
                          <button type="button"  class="btn btn-sm btn-success btn-block text-center">
                          <i class="fa fa-list text-white"> Montir Sedang Tutup / Sedang bekerja</i>
                        </button>
                        @endif
                      @else
                      <a href="{{route('login')}}" class="btn btn-sm btn-success btn-block text-center">
                        <i class="fa fa-list text-white"> Booking Montir</i>
                      </a>
                      @endauth
                      
                  </div>
              </div>
          </div>
      </section>
      <!-- end single product -->
  
      <!-- description dan review -->
      <section class="product-description p-4" id="scroll">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link " id="portofolio-tab" data-toggle="tab" href="#portofolio" role="tab" aria-controls="portofolio" aria-selected="true">Portofolio (<span>{{$montir->portfolio->count()}}</span>)</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="sertifikat-tab" data-toggle="tab" href="#sertifikat" role="tab" aria-controls="sertifikat" aria-selected="false">Sertifikat (<span>{{$montir->sertifikat->count()}}</span>)</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">review (<span>{{$reviews->count()}}</span>)</a>
                          </li>
                        </ul>
  
                        <div class="tab-content p-3" id="myTabContent">
                          <div class="tab-pane fade show active product-desc" id="portofolio" role="tabpanel" aria-labelledby="portofolio-tab">
                            @forelse ($montir->portfolio as $pt)
                              <div class="row ml-2 mb-3" id="scroll">
                                <div class="col">
                                  <img src="{{Storage::url($pt->foto)}}" alt="image" class="img-fluid shadow" style="width: 200px">
                                </div>
                                <div class="col-9 mt-2">
                                  <p>{{$pt->keterangan}}</p> <br>
                                  <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($pt->created_at))->diffForHumans()}}</small>
                                </div>
                              </div>
                            @empty
                                <div class="row">
                                  <div class="col-12">
                                    Portoflio tidak ada.
                                  </div>
                                </div>
                            @endforelse
                          </div>
  
                          <div class="tab-pane fade product-sertifikat" id="sertifikat" role="tabpanel" aria-labelledby="sertifikat-tab">
                            @forelse ($montir->sertifikat as $item)
                              <div class="row ml-2 mb-3" id="scroll">
                                <div class="col ">
                                    <img src="{{Storage::url($item->foto)}}" alt="" class="shadow" style="width: 200px;">
                                </div>
                                <div class="col-9 mt-2">
                                    <h5>{{$item->title}}</h5>
                                    <p>{{$item->keterangan}}</p>
                                    <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans()}}</small>
                                </div>
                            </div>
                            @empty
                            <div class="row">
                              <div class="col-12">
                                Sertifikat tidak ada.
                              </div>
                            </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade product-review" id="review" role="tabpanel" aria-labelledby="review-tab">
                          @forelse ($reviews as $item)
                            @if($item->review != '')
                            <div class="row ml-2 mb-3" id="scroll">
                              <div class="col ">
                                  @if ($item->foto)
                                  <img src="{{Storage::url($item->user->foto)}}" alt="" class="rounded-circle shadow" height="60px" width="60">

                                  @else
                                      <img src="https://ui-avatars.com/api/?name={{ $item->user->name }}" height="60" class="rounded-circle mr-1" />
                                  @endif
                              </div>
                              <div class="col-11 mt-2">
                              @for($i = 1; $i <= $item->rating->stars_rated; $i++)
                          <i style="font-size: 10px;"  class="fa fa-star checked"></i> 
                        @endfor
                                  <h5>{{$item->review}} ~ <q>{{$item->user->name}}</q> </h5>
                                  <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans()}}</small>
                              </div>
                          </div>
                            @endif
                          @empty
                          <div class="row">
                            <div class="col-12">
                              review tidak ada.
                            </div>
                          </div>
                          @endforelse
                      </div>
                  </div>
            </div>
        </section>
      <!-- akhir description dan review -->
      <div class="section" style="margin-bottom: 150px;  margin-top: 70px;"></div>
      <!-- end similar --> 

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Formulir Booking Montir - {{$montir->name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="{{route('booking.store')}}" method="post">
              <input type="hidden" name="montir_id" value="{{$montir->id}}">
              @csrf
              <div class="form-group">
                <label for="jenis_kerusakan">Jenis Kerusakan</label>
                <input type="text" class="form-control" id="jenis_kerusakan" name="jenis_kerusakan" required>
              </div>
              <div class="form-group">
                <label for="kronologi_kerusakan">Masalah kerusakan</label>
                <textarea name="kronologi_kerusakan" name="kronologi_kerusakan" id="kronologi_kerusakan" required class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="berapa_lama_kerusakan">Lama rusak</label>
                <input type="text" class="form-control" name="berapa_lama_kerusakan"  id="berapa_lama_kerusakan" required>
              </div>
              <div class="form-group">
                <label for="jadwal_penjemputan">Jadwal penjemputan</label>
                <input type="date" class="form-control" id="jadwal_penjemputan" name="jadwal_penjemputan" required>
              </div>
              <div class="form-group">
                <label for="alamat_penjemputan">Lokasi detail penjemputan</label>
                <input type="text" class="form-control" id="alamat_penjemputan" required name="alamat_penjemputan">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
