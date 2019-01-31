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
        if(count($params) == 0 ) return response()->json(['houses' => House::all()]);
        $name = null;
        $priceMin = null;
        $priceMax = null;
        $bedrooms = null;
        $bathrooms = null;
        $storeys = null;
        $garages = null;

        if(isset($params['name']) && $params['name'] != '') $name = $params['name'];
        if(isset($params['priceMin'])&&  $params['priceMin'] != '') $priceMin = $params['priceMin'];
        if(isset($params['priceMax']) && $params['priceMax'] != '') $priceMax = $params['priceMax'];
        if(isset($params['bedrooms']) && $params['bedrooms'] != '') $bedrooms = +$params['bedrooms'];
        if(isset($params['bathrooms']) && $params['bathrooms'] != '') $bathrooms  = +$params['bathrooms'];
        if(isset($params['storeys']) && $params['storeys'] != '') $storeys = +$params['storeys'];
        if(isset($params['garages']) && $params['garages'] != '') $garages = +$params['garages'];

        $houses = House::ofName($name)
            ->ofPrice(['min' => $priceMin, 'max' => $priceMax])
            ->ofBedrooms($bedrooms)
            ->ofBathrooms($bathrooms)
            ->ofStoreys($storeys)
            ->ofGarages($garages)
            ->get();
        return response()->json(['houses' => $houses]);
    }
}
