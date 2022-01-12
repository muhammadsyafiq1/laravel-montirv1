@extends('layouts.app')

@section('title')
	Montir
@stop

@section('content')
<!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
      <div class="carousel-inner">
        <div class="container">
          <div class="carousel-item active">
            <div class="row pt-5 justify-content-center">
              <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                <h1>Tentang Website Montir</h1>
                <p>Terdapat banyak montir dari berbagai daerah yang bisa membantumu,</p>
                <a href="#features" class="btn btn-warning text-white">Lihat Montir</a>
              </div>
              <div class="col-4 offset-1 d-none d-sm-block">
                <img src="/montir/asset/montir2.jpg" alt="slide show" style="width: 400px;">
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="row pt-5 justify-content-center">
              <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                <h1>Tentang Website Montir</h1>
                <p>Terdapat banyak kategori montir dari berbagai daerah yang bisa membantumu,</p>
                <a href="#features" class="btn btn-warning text-white">Lihat Montir</a>
              </div>
              <div class="col-4 offset-1 d-none d-sm-block">
                <img src="/montir/asset/montir3.jpg" alt="slide show" style="width: 400px;">
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="row pt-5 justify-content-center">
              <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                <h1>Tentang Website Montir</h1>
                <p>Terdapat banyak kategori montir dari berbagai daerah yang bisa membantumu,</p>
                <a href="#features" class="btn btn-warning text-white">Lihat Montir</a>
              </div>
              <div class="col-4 offset-1 d-none d-sm-block">
                <img src="/montir/asset/montir4.jpg" alt="slide show" style="width: 400px;">
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- end carouse; -->

    <!-- brands -->
    <section class="brands">
      <div class="container">
        <div class="row p-5 text-center">
          <div class="col-md">
            <img src="/montir/asset/brands/cc.png" class="img-fluid">
          </div>
          <div class="col-md">
            <img src="/montir/asset/brands/uniqlo.png" class="img-fluid">
          </div>
          <div class="col-md">
            <img src="/montir/asset/brands/nike.png" class="img-fluid">
          </div>
          <div class="col-md">
            <img src="/montir/asset/brands/pnb.png" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    <!-- end brands -->

    <!-- top montir -->
    <section class="features bg-light p-4" id="features">
      <div class="container">
        <div class="row d-flex justify-content-between">
          <div class="">
            <h3>Top Montir</h3>
            <p>{{$topMontir->count()}} Montir Pekerjaan Diselesaikan Terbanyak</p>
          </div>
          <div class="">
            <!-- <form action="{{url('/')}}" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Cari alamat ..." aria-label="Search" name="keyword">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
          </div>
        </div>

         <div class="row">
          @foreach ($topMontir as $tm)
            @if($tm->role != 'customer')
              <div class="col-6 col-md-4 col-lg-4">
              <figure class="figure">
                <div class="figure-img">
                  <img src="{{Storage::url($tm->foto)}}" alt="" style="width: 280px; height: 230px;">
                  <a href="{{route('detail',$tm->id)}}" class="d-flex justify-content-center">
                    <i class="fa fa-eye align-self-center" style="color: #f9b234;"></i>
                  </a>
                </div>
                <figcaption class="figure-caption text-center">
                  <h5>{{$tm->name}}</h5>
                  @if($tm->ketersediaan == 'tersedia')
                  <p style="font-weight: bold;" class="mt-0 text-primary"> Tersedia </p>
                  @else
                  <p style="font-weight: bold;" class="mt-0 text-danger"> Bekerja </p>
                  @endif
                </figcaption>
              </figure>
            </div>
            @endif
          @endforeach
        </div>
    </section>
    <!-- end top montir -->

    <!-- montir -->
    <section class="features bg-light p-4" id="features">
      <div class="container">
        <div class="row d-flex justify-content-between">
          <div class="">
            <h3>Pilihan Semua Montir</h3>
            <p>Terdapat {{$montirs->count()}} Montir yang handal</p>
          </div>
          <div class="">
            <form action="{{url('/')}}" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Cari alamat ..." aria-label="Search" name="keyword">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>

         <div class="row">
          @forelse ($montirs as $montir)
          <div class="col-6 col-md-4 col-lg-4">
            <figure class="figure">
              <div class="figure-img">
                <img src="{{Storage::url($montir->foto)}}" alt="" class="" style="height: 230px; width: 280px">
                <a href="{{route('detail',$montir->id)}}" class="d-flex justify-content-center">
                  <i class="fa fa-eye align-self-center" style="color: #f9b234;"></i>
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>{{$montir->name}}</h5>
                 @if($montir->ketersediaan == 'tersedia')
                  <p style="font-weight: bold;" class="mt-0 text-primary"> Tersedia </p>
                  @else
                  <p style="font-weight: bold;" class="mt-0 text-danger"> Bekerja </p>
                  @endif
              </figcaption>
            </figure>
          </div>
          @empty
              <div class="row">
                <div class="col-12">
                  Montir tidak ada
                </div>
              </div>
          @endforelse
        </div>
    </section>
    <!-- end montir -->


@stop

@push('scripts')
<script>
  $(document).ready(function() {
  
      $("#box").hide();
      $("#tombol_show").click(function() {
            $("#box").show();
          })
  
  });
</script>
@endpush