<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Models\Product;
use Illuminate\Http\Request;

class LovController extends Controller
{
    public function getProvinces(Request $request)
    {
        $provinces = Province::when($request->has('search'), function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->get();

        return response()->json([
            'success' => true,
            'data' => $provinces
        ]);
    }

    public function getCities($provinceCode, Request $request)
    {
        $cities = City::where('province_code', $provinceCode)
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->get();

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    public function getDistricts($cityCode, Request $request)
    {
        $districts = District::where('city_code', $cityCode)
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->get();

        return response()->json([
            'success' => true,
            'data' => $districts
        ]);
    }

    public function getVillages($districtCode, Request $request)
    {
        $villages = Village::where('district_code', $districtCode)
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->get();

        return response()->json([
            'success' => true,
            'data' => $villages
        ]);
    }

    public function getProducts(Request $request)
    {
        $products = Product::when($request->has('search'), function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
        })->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}