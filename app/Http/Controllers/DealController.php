<?php

namespace App\Http\Controllers;

use App\Services\DealService;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function __construct(
        private DealService $dealService,
    ) {}

    public function index()
    {
        $deals = $this->dealService->getAllForUser(Auth::user());

        return view('deals.index', compact('deals'));
    }

    public function show(string $id)
    {
        $deal = $this->dealService->findForUser(Auth::user(), $id);

        return view('deals.show', compact('deal'));
    }
}
