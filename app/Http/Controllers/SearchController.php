<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $params= $request->all();
        $name = $params['name'] ?? null;
        $priceMin = $params['price_min'] ?? null;
        $priceMax = $params['price_max'] ?? null;
        $bedrooms = $params['bedrooms'] ?? null;
        $bathrooms = $params['bathrooms'] ?? null;
        $storeys = $params['storeys'] ?? null;
        $garages = $params['garages'] ?? null;
        $houses = House::ofName($name)
            ->ofPrice([$priceMin, $priceMax])
            ->ofBedrooms($bedrooms)
            ->ofBathrooms($bathrooms)
            ->ofStoreys($storeys)
            ->ofGarages($garages)
            ->get();
        return response()->json(['houses' => $houses]);
    }
}
