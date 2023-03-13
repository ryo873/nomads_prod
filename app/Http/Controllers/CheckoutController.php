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

class CheckoutController extends Controller
{

    public function process(Request $request, $id){
        $travel_package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'additional_visa' => 0,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => Auth::user()->nationality ? Auth::user()->nationality : 'None',
            'is_visa' => Auth::user()->is_visa ? 1 : 0,
            'doe_passport' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function index(Request $request, $id){
        $item = Transaction::with(['details','travel_package','user'])->findOrFail($id);
        return view('pages.checkout', [
                "item" => $item
        ]);
    }

    public function create(Request $request, $id){
            $request->validate([
                'username' => 'required|string|exists:users,username',
                'is_visa' => 'required|boolean',
                'doe_passport' => 'required'
            ]);

            $data = $request->all();
            $data['transactions_id'] = $id;
            // belum selesai, menit ke 10:48

            TransactionDetail::create($data);

            $transaction = Transaction::with(['travel_package'])->find($id);

            if($request->is_visa){
                $transaction->transaction_total += 190;
                $transaction->additional_visa += 190;
            }

            $transaction->transaction_total += $transaction->travel_package->price;

            $transaction->save();

            return redirect()->route('checkout', $id);
    }

    public function remove(Request $request, $id){
        $item = TransactionDetail::findOrFail($id);

        $transaction = Transaction::with(['details','travel_package'])
                        ->findOrFail($item->transactions_id);

        if($item->is_visa){
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function success(Request $request, $id){
        $transaction = Transaction::with(['details','travel_package.galleries','user'])
            ->findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        // kirim email ke user eticket nya
        Mail::to($transaction->user)->send(
            new TransactionSuccess($transaction)
        );



        return view('pages.success');
    }

}
