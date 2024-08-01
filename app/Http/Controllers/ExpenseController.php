<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Financial;
use App\Models\Income;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $expenses = Expense::latest()->paginate(10);
        $page = $request->get('page', 1);
        $perPage = $expenses->perPage();
        $totalItems = $expenses->total();
        $startingNumber = $totalItems - (($page - 1) * $perPage);
        return view('expenses.index', compact('expenses', 'startingNumber'));
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
        Expense::create($request->all());

        $newAmount = Financial::latest('id')->first()->amount - $request->amount;

        Financial::create([
            'amount' => $newAmount,
            'nominal' => $request->amount,
            'expense_date' => $request->expense_date,
            'transaction_type' => 'Pengeluaran',
        ]);

        return redirect()->route('expenses')->with('success', 'Berhasil membuat data pengeluaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //    $expense->update($request->all());
        //    return redirect()->route('expenses')->with('success', 'Berhasil membuat Pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
