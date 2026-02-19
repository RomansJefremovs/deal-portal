<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessHubspotDeal;

class HubspotWebhookController extends Controller
{
    public function handle(Request $request): \Illuminate\Http\JsonResponse
{
    Log::info('HubSpot webhook received', $request->all());

    ProcessHubspotDeal::dispatch($request->all());

    return response()->json(['message' => 'ok'], 200);
}
}
