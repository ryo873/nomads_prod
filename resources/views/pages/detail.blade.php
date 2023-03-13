@extends('layouts.checkout')

@section('title')
    Detail Travel
@endsection

@section('content')
    </header>
    <main>
      <section class="section-details-header"></section>
      <section class="section-details-content">
        <div class="container">
          <div class="row">
            <div class="col p-0">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">Paket Travel</li>
                  <li class="breadcrumb-item active">Details</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 pl-lg-0">
              <div class="card card-details">


                <h1>{{ $item->title }}</h1>
                <p>{{ $item->location }}</p>

                <div class="gallery">
                    @if($item->galleries->count())
                        <div class="xzoom-container">
                            <img src="{{ Storage::url($item->galleries->first()->image ) }}" alt="details" class="xzoom xzoom-header img-fluid" id="xzoom-default" xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                        </div>
                    @endif
                  <div class="zoom-thumbs">
                    @foreach($item->galleries as $gallery)
                    <a href="{{ Storage::url($gallery->image) }}">
                      <img src="{{ Storage::url($gallery->image) }}" alt="details-mini" class="xzoom-gallery" width="120" xpreview="{{ Storage::url($gallery->image) }}" />
                    </a>
                    @endforeach
                  </div>
                </div>
                <h2>Tentang Wisata</h2>
                <p>{{ $item->about }}</p>
                <div class="features row">
                  <div class="col-md-4">
                    <div class="description">
                      <img src="{{ url('frontend/images/event.png') }}" alt="event" class="featured-image" />
                      <div class="description">
                        <h3>Featured Event</h3>
                        <p>{{ $item->featured_event }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 border-left">
                    <div class="description">
                      <img src="{{ url('frontend/images/languange.png') }}" alt="languange" class="featured-image" />
                      <div class="description">
                        <h3>Languange</h3>
                        <p>{{ $item->languange }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 border-left">
                    <div class="description">
                      <img src="{{ url('frontend/images/foods.png') }}" alt="foods" class="featured-image" />
                      <div class="description">
                        <h3>Foods</h3>
                        <p>{{ $item->foods }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-details card-right">
                <!-- <h2>Members are going</h2>
                <div class="members my-2">
                  <img src="frontend/images/member-1.png" alt="members" class="member-image mr-1" />
                  <img src="frontend/images/member-2.png" alt="members" class="member-image mr-1" />
                  <img src="frontend/images/member-3.png" alt="members" class="member-image mr-1" />
                  <img src="frontend/images/member-4.png" alt="members" class="member-image mr-1" />
                  <img src="frontend/images/more-member-9.png" alt="members" class="member-image mr-1" />
                </div>
                <hr /> -->
                <h2>Trip Information</h2>
                <table class="trip-information">
                  <tr>
                    <th width="50%">Date of Departure</th>
                    <td width="50%" class="text-right">{{ \Carbon\Carbon::create($item->departure_date)->format('F j, Y') }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Duration</th>
                    <td width="50%" class="text-right">{{ $item->duration }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Type</th>
                    <td width="50%" class="text-right">{{ $item->type }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Price</th>
                    <td width="50%" class="text-right">${{ $item->price }},00 / person</td>
                  </tr>
                </table>
              </div>
              @if(Auth::check())
              <div class="join-container">
                <form action="{{ route('checkout-proccess', $item->id) }}" method="post">
                    @csrf
                    <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                        Join Now
                    </button>
                </form>
              </div>
              @else
              <div class="join-container">
                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Register/Login Required</a>
              </div>
              @endif
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{url('frontend/libraries/xzoom/xzoom.css')}}" />
@endpush

@push('addon-script')
<script src="{{url ('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".xzoom, .xzoom-gallery").xzoom({
            zoomwidth: 500,
            title: false,
            tint: "#333",
            xoffset: 15,
        });
    });
</script>
@endpush
