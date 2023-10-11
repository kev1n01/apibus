<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverResource;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where(
            function ($query) {
                $query->where('lat', '!=', null)
                    ->where('lng', '!=', null);
            }
        )->get();
        return DriverResource::collection($drivers);
    }

    public function create(DriverRequest $request)
    {
        $driver = Driver::create($request->validated());
        return response()->json(['id' => $driver->id], 200);
    }
    public function update(DriverRequest $request, $id)
    {
        $driver = Driver::find($id);
        $driver->update($request->validated());
        return response()->json(['message' => 'Driver updated'], 200);
    }
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
        return response()->json(['message' => 'Driver deleted'], 200);
    }
}