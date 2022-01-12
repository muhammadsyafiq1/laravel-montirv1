@extends('layouts.app')

@section('title')
    Kategori
@endsection

@section('content')
<div class="page-content page-home">
    <!-- all categories -->
    <section class="store-trend-categories">
      <div class="container">
        <div class="row">
          <div class="col-12" >
            <h5 class="mb-4">Semua Kategori</h5>
          </div>
          @foreach ($categories as $category)
          <div class="col-4 col-md-4 col-lg-4 mb-5">
            <a href="{{url('kategori-montir',$category->id)}}" class="component-categories d-block">
              <div class="categories-image">
                <div class="" style="width: 300px;">
                    <i class="{{$category->url_icon}} text-primary"> &nbsp; &nbsp;
                        <span class="text-dark">{{ $category->nama_category }}</span>
                    </i>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
</div>

<section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5 class="mb-3">Semua montir</h5>
        </div>
      </div>
      <div class="row" style="margin-bottom: 330px;">
        @forelse ($montirs as $montir)
        <div class="col-6 col-md-4 col-lg-4">
          <figure class="figure">
            <div class="figure-img">
              <img src="{{Storage::url($montir->foto)}}" alt="" class="figure-img img-fluid rounded" width="300px">
              <a href="{{route('detail',$montir->id)}}" class="d-flex justify-content-center">
                <i class="fa fa-plus-circle align-self-center" style="color: #f9b234;"></i>
              </a>
            </div>
            <figcaption class="figure-caption text-center">
              <h5>{{$montir->name}} - <span class="text-success">{{$montir->ketersediaan}}</span></h5>
              <p style="font-weight: bold;" class="mt-0"> Specialist : {{$montir->category->nama_category}} </p>
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
    </div>
</section>
@endsection

<style>

    .store-trend-categories {
        margin-top: 100px;
    }
    h5 {
        font-weight:300;
        margin-bottom: 15px;
    }
    .store-new-product {
        margin-top: 10px;
    }

</style>