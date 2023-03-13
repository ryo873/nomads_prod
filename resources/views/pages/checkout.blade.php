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
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img
                                                            src="{{ url('frontend/images/remove.png')}}"
                                                            alt="remove"
                                                        />
                                                    </a>
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
                                <div class="member mt-3">
                                    <h2>Add Member</h2>
                                    <form class="form-inline" method="post" action="{{ route('checkout-create', $item->id ) }}">
                                        @csrf
                                        <label
                                            for="username"
                                            class="sr-only"
                                            >Name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control mb-2 mr-sm-2"
                                            id="username"
                                            name="username"
                                            placeholder="Username"
                                        />

                                        <label
                                            for="nationality"
                                            class="sr-only"
                                            >Nationality</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control mb-2 mr-sm-2"
                                            id="nationality"
                                            name="nationality"
                                            placeholder="Nationality"
                                            required
                                            style="width: 50px"
                                        />

                                        <label for="is_visa" class="sr-only"
                                            >Visa</label
                                        >
                                        <select
                                            name="is_visa"
                                            id="is_visa"
                                            class="custom-select mb-2 mr-sm-2"
                                        >
                                            <option value="">VISA</option>
                                            <option value="1">
                                                30 Days
                                            </option>
                                            <option value="0">N/A</option>
                                        </select>

                                        <label for="doe_passport" class="sr-only"
                                            >DOE Passport</label
                                        >
                                        <div class="input-group mb-2 mr-sm-2">
                                            <!-- <input type="text" class="form-control datepicker" id="doePassport" placeholder="DOE Passport" /> -->
                                            <!-- <input type="date" name="doe_passport" id="doe_passport"> -->
                                            <input
                                                id="datepicker"
                                                name="doe_passport"
                                                type="date"
                                                class="form-control datepicker"
                                                width="158"
                                                placeholder="DOE Passport"
                                            />
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-add-now mb-2 px-4"
                                        >
                                            Add Now
                                        </button>
                                    </form>

                                    <h3 class="mt-2 mb-0">Note</h3>
                                    <p class="disclaimer mb-0">
                                        You are only able to invite member that
                                        has registered in Nomads
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-details card-right">
                                <h2>Checkout Information</h2>
                                <table class="table trip-information">
                                    <tr>
                                        <th width="50%">Members</th>
                                        <td width="50%" class="text-right">
                                            {{ $item->details->count() }} Person
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%">Additional Visa</th>
                                        <td width="50%" class="text-right">
                                            ${{ $item->additional_visa }},00
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%">Trip Price</th>
                                        <td width="50%" class="text-right">
                                            $ {{ $item->travel_package->price }} / Person
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%">Total Price</th>
                                        <td width="50%" class="text-right">
                                            $ {{ $item->transaction_total }},00
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="50%">Total (+Unique)</th>
                                        <td
                                            width="50%"
                                            class="text-right text-total"
                                        >
                                            <span class="text-blue"
                                                >$ {{ $item->transaction_total }},</span
                                            >
                                            <span class="text-orange">{{ mt_rand(0,99) }}</span>
                                        </td>
                                    </tr>
                                </table>
                                <hr />
                                <h2>Payment Instruction</h2>
                                <p class="payment-instruction">
                                    Please continue the payment before you
                                    continue the trip
                                </p>
                                <div class="bank">
                                    <div class="bank-item pb-3">
                                        <img
                                            src="{{ url('frontend/images/bank_ic.png') }}"
                                            alt="bank_icon"
                                            class="bank-image"
                                        />
                                        <div class="description">
                                            <h1>PT Nomads ID</h1>
                                            <p>
                                                Bank Central Asia
                                                <br />
                                                0829 0999 8390
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="bank">
                                    <div class="bank-item pb-3">
                                        <img
                                            src="{{ url('frontend/images/bank_ic.png') }}"
                                            alt="bank_icon"
                                            class="bank-image"
                                        />
                                        <div class="description">
                                            <h1>PT Nomads ID</h1>
                                            <p>
                                                Bank Central Asia
                                                <br />
                                                0829 0999 8390
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="join-container">
                                <a
                                    href="{{ route('checkout-confirm', $item->id ) }}"
                                    class="btn btn-block btn-join-now mt-3 py-2"
                                    >I Have Made Payment</a
                                >
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('home') }}" class="text-muted">
                                    Cancel Booking
                                </a>
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
