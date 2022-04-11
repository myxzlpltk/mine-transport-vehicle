<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        $this->authorize('view-any', Vehicle::class);

        return view('vehicles.index', [
            'vehicles' => Vehicle::query()
                ->withCount('travels')
                ->orderBy('brand')
                ->orderBy('model')
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
        $this->authorize('create', Vehicle::class);

        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreVehicleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreVehicleRequest $request) {
        $this->authorize('create', Vehicle::class);

        $vehicle = new Vehicle;
        $vehicle->type = $request->type;
        $vehicle->model = $request->model;
        $vehicle->brand = $request->brand;
        $vehicle->color = $request->color;
        $vehicle->year = $request->year;
        $vehicle->plate = $request->plate;
        $vehicle->save();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Vehicle $vehicle) {
        $this->authorize('view', $vehicle);

        return view('vehicles.view', [
            'vehicle' => $vehicle->loadCount('travels'),
            'travels' => $vehicle->travels()
                ->orderBy('started_at', 'desc')
                ->orderBy('ended_at', 'desc')
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Vehicle $vehicle) {
        $this->authorize('update', $vehicle);

        return view('vehicles.edit', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateVehicleRequest $request
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle) {
        $this->authorize('update', $vehicle);

        $vehicle->type = $request->type;
        $vehicle->model = $request->model;
        $vehicle->brand = $request->brand;
        $vehicle->color = $request->color;
        $vehicle->year = $request->year;
        $vehicle->plate = $request->plate;
        $vehicle->save();

        return redirect()
            ->route('vehicles.show', $vehicle)
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Vehicle $vehicle) {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
