<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CurrencyApiController extends Controller
{
    /**
     * Api url for crypto rate fetch
     *
     * @var string
     */
    private $ratesApiUrl = 'https://api.coingecko.com/api/v3/simple/price';

    /**
     * Supported currencies.
     *
     * @var string[]
     */
    private $currencies = [
        'bitcoin',
        'litecoin'
    ];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $response = Http::get($this->ratesApiUrl.'?'.http_build_query([
                'ids' => implode(',', $this->currencies),
                'vs_currencies' => 'eur'
            ]));

        if($response->status() !== 200){
            return response()->json([], $response->status());
        }

        // TODO in real app we can cache results or update them via cron and save in DB.
        $data = $response->json();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $currency
     * @return JsonResponse
     */
    public function show(Request $request, $currency): JsonResponse
    {
        if(!in_array($currency, $this->currencies))
            return response()->json(['message' => 'currency not found'], 404);

        $response = Http::get($this->ratesApiUrl.'?'.http_build_query([
            'ids' => $currency,
            'vs_currencies' => 'eur'
        ]));

        if($response->status() !== 200){
            return response()->json([], $response->status());
        }

        // TODO in real app we can cache results or update them via cron and save in DB.
        $data = $response->json();

        return response()->json($data);
    }
}
