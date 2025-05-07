<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\Country\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(
        protected CountryService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:countries,code',
        ]);

        $country = $this->service->create($request->only('name', 'code'));
        return response()->json($country, 201);
    }

    public function show(Country $country)
    {
        return response()->json($this->service->show($country));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:countries,code,' . $country->id,
        ]);

        $updated = $this->service->update($country, $request->only('name', 'code'));
        return response()->json($updated);
    }

    public function destroy(Country $country)
    {
        $this->service->delete($country);
        return response()->json(null, 204);
    }
}
