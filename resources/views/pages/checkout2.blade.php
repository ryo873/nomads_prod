@extends('layouts.checkout')

@section('title')
 Checkout
@endsection

@section('content')
<main>
            <section class="section-details-header"></section>
            <section class="section-details-content">
                <div class="container">
                    <div class="row">
                        <div class="col p-0">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        Paket Travel
                                    </li>
                                    <li class="breadcrumb-item">Details</li>
                                    <li class="breadcrumb-item active">
                                        Checkout
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 pl-lg-0">
                            <div class="card card-details">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <h1>Who is Going?</h1>
                                <p>{{ $item->travel_package->title }}, Indonesia</p>
                                <div class="attendee">
                                    <table
                                        class="table table-response-sm text-center"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Picture</th>
                                                <th>Name</th>
                                                <th>Nationality</th>
                                                <th>Visa</th>
                                                <th>Passport</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img
                                                        src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        alt="avatar"
                                                        height="60"
                                                        class="rounded-circle"
                                                    />
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->username }}
                                                </td>
                                                <td class="align-middle">{{ $detail->nationality }}</td>
                                                <td class="align-middle">
                                                    {{ $detail->is_visa ? '30 Days' : 'N/A' }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Active' : 'Inactive'}}
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        No Visitor
                                                    </td>
                                                </tr>
                                            @endforelse


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
<script>
    // $(document).ready(function () {
    //     $(".xzoom, .xzoom-gallery").xzoom({
    //         zoomwidth: 500,
    //         title: false,
    //         tint: "#333",
    //         xoffset: 15,
    //     });
    // });

    // $(".datepicker").datepicker({
    //   uilibrary: "bootstrap4",
    //   // icons: {
    //   //   rightIcon: '<img src="frontend/images/calendar_ic.png"/>',
    //   // },
    // });

    $(".datepicker").datepicker({
        uiLibrary: "bootstrap4",
        // icons: {
        //   rightIcon: '<img src="frontend/images/calendar_ic.png" width="20px"/>',
        // },
    });
</script>
@endpush
