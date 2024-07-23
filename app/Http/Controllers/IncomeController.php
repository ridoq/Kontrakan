<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
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
            $incomes = Income::where('user_id', Auth::user()->id)->latest()->paginate(10);
        } else {
            $incomes = Income::latest()->paginate(10);
        }
        return view('incomes.index', compact('incomes'));
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
    public function store(Request $request)
    {
        $paymentProof = $request->payment_proof->store('payment_proofs', 'public');
        Income::create([
            'payment_proof' => $paymentProof,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'income_date' => $request->income_date,
            'description' => $request->description,
        ]);
        return redirect()->route('incomes')->with('success', 'Proses pembayaran berhasil dibuat, silahkan tunggu konfirmasi dari admin');
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
