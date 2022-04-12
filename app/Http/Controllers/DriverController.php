<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;

class DriverController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        $this->authorize('view-any', Driver::class);

        return view('drivers.index', [
            'drivers' => Driver::query()
                ->withCount('travels')
                ->orderBy('name')
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
        $this->authorize('create', Driver::class);

        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreDriverRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreDriverRequest $request) {
        $this->authorize('create', Driver::class);

        $driver = new Driver;
        $driver->name = $request->name;
        $driver->age = $request->age;
        $driver->save();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Driver $driver) {
        $this->authorize('view', $driver);

        return view('drivers.view', [
            'driver' => $driver->loadCount('travels'),
            'travels' => $driver->travels()
                ->with('vehicle')
                ->orderBy('started_at', 'desc')
                ->orderBy('ended_at', 'desc')
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Driver $driver) {
        $this->authorize('update', $driver);

        return view('drivers.edit', [
            'driver' => $driver
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDriverRequest $request
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateDriverRequest $request, Driver $driver) {
        $this->authorize('update', $driver);

        $driver->name = $request->name;
        $driver->age = $request->age;
        $driver->update();

        return redirect()
            ->route('drivers.show', $driver)
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Driver $driver) {
        $this->authorize('delete', $driver);

        $driver->delete();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
