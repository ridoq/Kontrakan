<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Financial;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('member')) {
            $incomes = Income::where('user_id', Auth::user()->id)->latest()->paginate(5);
        } else {
            $incomes = Income::latest()->paginate(10);
        }

        //UserIncomeLogic
        {
            $totalIncome = Income::where('user_id', Auth::user()->id)
                ->where('status', 'diterima')
                ->sum('amount');

            //KAS 15 RIBU
            $startDate = Auth::user()->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d');
            $currentDate = date('Y-m-d');
            $startDateTimestamp = strtotime($startDate);
            $currentDateTimestamp = strtotime($currentDate);
            $daysDifference = ($currentDateTimestamp - $startDateTimestamp) / (60 * 60 * 24);
            $dailyPayment = 15000;
            $totalPaymentExpected = $daysDifference * $dailyPayment;


            if ($totalIncome < $totalPaymentExpected) {
                $outstandingPayment = 'Rp. ' . number_format($totalPaymentExpected - $totalIncome);
            } else {
                $outstandingPayment = "Rp. " . 0; // Jika totalIncome lebih besar atau sama dengan totalPaymentExpected
            }
        };

        return view('incomes.index', compact('incomes', 'outstandingPayment', 'totalIncome'));
    }


    public function cancel(Income $income)
    {

        $income->delete();
        return redirect()->route('incomes')->with('success', 'Pembayaran berhasil dibatalkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeRequest $request)
    {
        $paymentProof = $request->payment_proof->store('payment_proofs', 'public');

        $incomes = Income::where('user_id',$request->user_id)->get(); 

        $dateNow = date('Y-m-d');
        $incomeDate =
        $latestIncome = $member->incomes->sortByDesc('has_paid_until')->first(); // Mendapatkan income terbaru
        $hasPaidUntil = $latestIncome
            ? \Carbon\Carbon::parse($latestIncome->has_paid_until)->format('d F Y')
            : 'Belum ada data';

        Income::create([
            'payment_proof' => $paymentProof,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'income_date' => $request->income_date,
            'description' => $request->description,
            'has_paid_until' => $request->income_date,
        ]);

        return redirect()->route('incomes')->with('success', 'Proses pembayaran berhasil dibuat, silahkan tunggu konfirmasi dari admin');
    }

    public function accept(Income $income)
    {
        if (Financial::count() === 0) {
            $newAmount = Financial::sum('amount') + $income->amount;

            Financial::create([
                'amount' => $newAmount,
                'nominal' => $income->amount,
                'transaction_type' => 'Pemasukan',
            ]);
        } else {
            $newAmount = Financial::latest('id')->first()->amount + $income->amount;

            Financial::create([
                'amount' => $newAmount,
                'nominal' => $income->amount,
                'transaction_type' => 'Pemasukan',
            ]);
        }

        $income->status = 'Diterima';
        $income->save();

        $paid_day = $income->amount / 15000;
        $incomeDate = Carbon::parse($income->has_paid_until);
        $income->has_paid_until = $incomeDate->addDays($paid_day)->format('Y-m-d');
        $income->save();

        return redirect()->route('incomes')->with('success', 'Berhasil membayar uang kas');
    }

    public function reject(Income $income)
    {
        $user = User::find($income->user_id);
        $income->status = 'Ditolak';
        $income->save();
        return redirect()->route('incomes')->with('error', 'Pembayaran dari ' . $user->name . ' Ditolak');
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeRequest $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        //
    }
}
