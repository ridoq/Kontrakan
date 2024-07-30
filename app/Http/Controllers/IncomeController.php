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
        $users = User::role('member')->get();
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
            $startDate = Auth::user()->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d'); //24
            $currentDate = date('Y-m-d'); //27
            $startDateTimestamp = strtotime($startDate);
            $currentDateTimestamp = strtotime($currentDate);
            $daysDifference = ($currentDateTimestamp - $startDateTimestamp) / (60 * 60 * 24) + 1; //4
            $dailyPayment = 15000;
            $totalPaymentExpected = $daysDifference * $dailyPayment; //60


            if ($totalIncome < $totalPaymentExpected) {
                $outstandingPayment = $totalPaymentExpected - $totalIncome;
            } else {
                $outstandingPayment = 0;
            }
        };

        return view('incomes.index', compact('incomes', 'outstandingPayment', 'totalIncome', 'users'));
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

        $lastIncome = Income::where('user_id', Auth::user()->id)->latest()->first();

        if ($lastIncome) {
            Income::create([
                'payment_proof' => $paymentProof,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'income_date' => $request->income_date,
                'description' => $request->description,
                'has_paid_until' => $lastIncome->has_paid_until,
            ]);
        } else {
            $startDate = Auth::user()->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d'); //28
            $currentDate = date('Y-m-d'); //28
            $startDateTimestamp = strtotime($startDate);
            $currentDateTimestamp = strtotime($currentDate);
            if ($startDateTimestamp === $currentDateTimestamp) {
                $daysDifference = ($currentDateTimestamp / $startDateTimestamp); //1
            } else {
                $daysDifference = ($currentDateTimestamp - $startDateTimestamp) / (60 * 60 * 24) + 1; //1
            }
            $incomeDateRaw = Carbon::parse($currentDate);//27
            $income_date = $incomeDateRaw->subDays($daysDifference)->format('Y-m-d');//23
            Income::create([
                'payment_proof' => $paymentProof,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'income_date' => $request->income_date,
                'description' => $request->description,
                'has_paid_until' => $income_date //23
            ]);
        }

        return redirect()->route('incomes')->with('success', 'Proses pembayaran berhasil dibuat, silahkan tunggu konfirmasi dari admin');
    }

    public function accept( Income $income)
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


        // logika hutang piutang
        $paid_day = ($income->amount / 15000);//1
        $incomeDate = Carbon::parse($income->has_paid_until);//26
        $income->has_paid_until = $incomeDate->addDays($paid_day)->format('Y-m-d');//28
        // dd($income->has_paid_until);
        $income->status = 'Diterima';

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
