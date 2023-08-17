<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CurrencyService;

class CurrencyController extends Controller
{
    Protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    public function convertCurrency(Request $request)
    {
        // dd($request->all());
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount');

        $result = $this->currencyService->convertCurrency($from, $to, $amount);

        return response()->json([
            'converted_amount' => $result,
        ]);
    }
}
