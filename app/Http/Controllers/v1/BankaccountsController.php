<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\StoreBankaccountsRequest;
use App\Http\Requests\UpdateBankaccountsRequest;
use App\Models\Bankaccounts;

class BankaccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankaccountsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankaccountsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bankaccounts  $bankaccounts
     * @return \Illuminate\Http\Response
     */
    public function show(Bankaccounts $bankaccounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bankaccounts  $bankaccounts
     * @return \Illuminate\Http\Response
     */
    public function edit(Bankaccounts $bankaccounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankaccountsRequest  $request
     * @param  \App\Models\Bankaccounts  $bankaccounts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankaccountsRequest $request, Bankaccounts $bankaccounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bankaccounts  $bankaccounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bankaccounts $bankaccounts)
    {
        //
    }
}
