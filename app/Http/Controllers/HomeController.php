<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Financial;
use App\Models\Income;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $financials = Financial::all();

    $incomes = [];
    $expenses = [];
    $labels = [];

    $lastIncomes = [];
    $lastExpenses = [];

    foreach ($financials as $financial) {
        $date = $financial->created_at->format('l, d F Y');

        if ($financial->transaction_type === 'Pemasukan') {
            $lastIncomes[$date] = $financial->amount;
        } else {
            $lastExpenses[$date] = $financial->amount;
        }
    }

    $dates = array_unique(array_merge(array_keys($lastIncomes), array_keys($lastExpenses)));
    sort($dates);

    foreach ($dates as $date) {
        $labels[] = $date;
        $incomes[] = isset($lastIncomes[$date]) ? $lastIncomes[$date] : 0;
        $expenses[] = isset($lastExpenses[$date]) ? $lastExpenses[$date] : 0;
    }

    // Calculate totals
    $totalIncome = array_sum($incomes);
    $totalExpense = array_sum($expenses);
    $netTotal = $totalIncome - $totalExpense;

    // Calculate percentage change if needed
    $percentageChange = $totalIncome > 0 ? ($netTotal / $totalIncome) * 100 : 0;

    return view('dashboard', compact('incomes', 'expenses', 'labels', 'totalIncome', 'totalExpense', 'netTotal', 'percentageChange'));
}

}
