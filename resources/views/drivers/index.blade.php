@extends('layouts.app')

@section('title', 'Data Driver')

@section('actions')
    @can('create', \App\Models\Driver::class)
        <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-sm">
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
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Total Perjalanan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($drivers as $driver)
                        <tr>
                            <td>{{ $drivers->firstItem() + $loop->index }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->age }} Tahun</td>
                            <td>{{ $driver->travels_count }} Perjalanan</td>
                            <td>
                                @can('view', $driver)
                                    <a href="{{ route('drivers.show', $driver) }}"
                                       class="btn btn-primary btn-sm">Lihat</a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $drivers->links() }}
        </div>
    </div>
@endsection
