@extends('layouts.admin')

@section('content')
     <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Transaksi </h1>
    </div>


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('transaction.update', $item->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="transaction_status">Status Transaksi</label>
                    <select name="transaction_status" required class="form-control">
                        <option value="{{ $item->transaction_status }}">
                            Jangan Diubah ({{ $item->transaction_status }})
                        </option>
                        <option value="IN_CART">IN_CART</option>
                        <option value="PENDING">PENDING</option>
                        <option value="SUCCESS">SUCCESS</option>
                        <option value="CANCEL">CANCEL</option>
                        <option value="FAILED">FAILED</option>
                    </select>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Ubah</button>
            </form>
        </div>
    </div>




</div>
<!-- /.container-fluid -->
@endsection
