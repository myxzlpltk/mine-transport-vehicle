<?php

namespace App\Http\Controllers;

use App\Enums\TravelStatus;
use App\Models\Driver;
use App\Models\Travel;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function index(Request $request) {
        return view('dashboard', [
            'total_vehicles' => Vehicle::query()->count(),
            'total_drivers' => Driver::query()->count(),
            'total_travels' => Travel::query()->where('status', TravelStatus::Validated)->count(),
            'total_pending_requests' => $request->user()->travels()->where('status', TravelStatus::Pending)->count(),
            'travels' => $this->stats(Travel::query()),
            'pending_reviews' => $request->user()->role != 'validator' ? null : Travel::query()
                ->with(['driver', 'vehicle'])
                ->where('status', TravelStatus::Pending)
                ->orderBy('started_at')
                ->paginate(10)
        ]);
    }

    private function stats(Builder $query) {
        $data = $query
            ->select(
                DB::raw('count(id) as count'),
                DB::raw("DATE_FORMAT(started_at,'%e') as dayKey")
            )
            ->groupBy('dayKey')
            ->orderByDesc('started_at')
            ->where('status', TravelStatus::Validated)
            ->whereDate('started_at', '>=', Carbon::now()->firstOfMonth())
            ->get();

        $stats = new Collection();
        for ($i = 1; $i <= 31; $i++) {
            $stats->push((object)[
                'key' => $i,
                'label' => $i,
                'data' => 0
            ]);
        }

        foreach ($data as $item) {
            $stats
                ->firstWhere('key', '=', $item->dayKey)
                ->data = intval($item->count);
        }

        return $stats;
    }
}
