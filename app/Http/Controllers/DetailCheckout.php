<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TransactionSuccess;

use App\TransactionDetail;
use App\TravelPackage;
use App\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DetailCheckout extends Controller
{
    //
    public function index(Request $request, $id){
        $item = Transaction::with(['details','travel_package','user'])->findOrFail($id);
        return view('pages.checkout2', [
                "item" => $item
        ]);
    }
}
