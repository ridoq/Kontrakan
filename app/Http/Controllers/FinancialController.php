<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Http\Requests\StoreFinancialRequest;
use App\Http\Requests\UpdateFinancialRequest;
use App\Models\User;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $members = User::role('member')->with('incomes')->get();
        $financials = Financial::latest()->paginate(10);

        $page = $request->get('page', 1);
        $perPage = $financials->perPage();
        $totalItems = $financials->total();
        $startingNumber = $totalItems - (($page - 1) * $perPage);
        return view("financials.index", compact("financials", "members", "startingNumber"));
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
    public function store(StoreFinancialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Financial $financial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Financial $financial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinancialRequest $request, Financial $financial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Financial $financial)
    {
        //
    }
}
