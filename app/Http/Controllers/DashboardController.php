<?php

namespace App\Http\Controllers;

use App\Enums\TravelStatus;
use App\Models\Driver;
use App\Models\Travel;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function index(Request $request) {
        return view('dashboard', [
            'total_vehicles' => Vehicle::query()->count(),
            'total_drivers' => Driver::query()->count(),
            'total_travels' => Travel::query()->where('status', TravelStatus::Validated)->count(),
            'total_pending_requests' => $request->user()->travels()->where('status', TravelStatus::Pending)->count(),
        ]);
    }
}
