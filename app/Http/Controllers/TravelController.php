<?php

namespace App\Http\Controllers;

use App\Enums\TravelStatus;
use App\Exports\TravelExport;
use App\Models\Driver;
use App\Models\Travel;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        $this->authorize('view-any', Travel::class);

        return view('travels.index', [
            'travels' => Travel::query()
                ->with(['vehicle', 'driver'])
                ->latest()
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $this->authorize('create', Travel::class);

        return view('travels.create', [
            'vehicles' => Vehicle::query()
                ->orderBy('brand')
                ->orderBy('model')
                ->get(),
            'drivers' => Driver::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTravelRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreTravelRequest $request) {
        $this->authorize('create', Travel::class);

        $travel = new Travel;
        $travel->driver_id = $request->driver_id;
        $travel->vehicle_id = $request->vehicle_id;
        $travel->started_at = $request->started_at;
        $travel->ended_at = $request->ended_at;
        $travel->creator_id = $request->user()->id;
        $travel->status = TravelStatus::Pending;
        $travel->save();

        return redirect()
            ->route('travels.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Travel $travel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Travel $travel) {
        $this->authorize('view', $travel);

        return view('travels.view', [
            'travel' => $travel->load(['vehicle', 'driver'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Travel $travel
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Travel $travel) {
        $this->authorize('update', $travel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTravelRequest $request
     * @param \App\Models\Travel $travel
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateTravelRequest $request, Travel $travel) {
        $this->authorize('update', $travel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Travel $travel
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Travel $travel) {
        $this->authorize('delete', $travel);

        $travel->delete();

        return redirect()
            ->route('travels.index')
            ->with('success', 'Data berhasil dihapus.');
    }


    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export() {
        $this->authorize('view-any', Travel::class);

        return view('travels.export');
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function download(Request $request) {
        $this->authorize('view-any', Travel::class);

        return Excel::download(new TravelExport($request->started_at, $request->ended_at), "travels {$request->started_at}-{$request->ended_at}.xlsx");
    }
}
