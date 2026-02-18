<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HubspotWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('HubSpot webhook received', $request->all());

        return response()->json(['message' => 'ok'], 200);
    }
}
