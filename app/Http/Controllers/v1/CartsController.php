<?php

namespace App\Http\Controllers\v1;

use App\Models\Carts;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCartsRequest;
use App\Http\Requests\UpdateCartsRequest;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartsRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Carts $carts): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carts $carts): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartsRequest $request, Carts $carts): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carts $carts): RedirectResponse
    {
        //
    }
}
