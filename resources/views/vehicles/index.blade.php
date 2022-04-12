@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('actions')
    @can('create', \App\Models\Vehicle::class)
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus fa-fw"></i>
            <span>Tambah Data</span>
        </a>
    @endcan
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis</th>
                        <th>Merk Model</th>
                        <th>Plat</th>
                        <th>Tahun</th>
                        <th>Total Perjalanan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicles->firstItem() + $loop->index }}</td>
                            <td>{{ ucwords($vehicle->type) }}</td>
                            <td>{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->color }})</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>{{ $vehicle->travels_count }} Perjalanan</td>
                            <td>
                                @can('view', $vehicle)
                                    <a href="{{ route('vehicles.show', $vehicle) }}"
                                       class="btn btn-primary btn-sm">Lihat</a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $vehicles->links() }}
        </div>
    </div>
@endsection
