<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function index()
{
    $deals = Auth::user()->deals()->latest()->get();

    return view('deals.index', compact('deals'));
}

public function show(string $id)
{
    $deal = Auth::user()->deals()->findOrFail($id);

    return view('deals.show', compact('deal'));
}
}
