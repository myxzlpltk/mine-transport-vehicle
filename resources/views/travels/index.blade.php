@extends('layouts.app')

@section('title', 'Data Perjalanan')

@section('actions')
    @can('view-any', \App\Models\Travel::class)
        <a href="{{ route('travels.export') }}" class="btn btn-info btn-sm">
            <i class="fa fa-file-export fa-fw"></i>
            <span>Export Data</span>
        </a>
    @endcan
    @can('create', \App\Models\Travel::class)
        <a href="{{ route('travels.create') }}" class="btn btn-primary btn-sm">
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
                        <th>Kendaraan</th>
                        <th>Driver</th>
                        <th>Waktu Perjalanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($travels as $travel)
                        <tr>
                            <td>{{ $travels->firstItem() + $loop->index }}</td>
                            <td>
                                <a href="{{ route('vehicles.show', $travel->vehicle) }}">{{ $travel->vehicle?->brand }} {{ $travel->vehicle?->model }}
                                    ({{ $travel->vehicle?->color }})</a>
                            </td>
                            <td>
                                <a href="{{ route('drivers.show', $travel->driver) }}">{{ $travel->driver?->name }}</a>
                            </td>
                            <td>{{ $travel->started_at->translatedFormat('d/m/Y h:i') }}
                                - {{ $travel->ended_at->translatedFormat('d/m/Y h:i') }}</td>
                            <td>
                                <span
                                    class="badge {{ $travel->status == \App\Enums\TravelStatus::Pending ? 'badge-primary' : ($travel->status == \App\Enums\TravelStatus::Validated ? 'badge-success' : 'badge-danger') }}">{{ strtoupper($travel->status->getValue()) }}</span>
                            </td>
                            <td>
                                @can('view', $travel)
                                    <a href="{{ route('travels.show', $travel) }}"
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

            {{ $travels->links() }}
        </div>
    </div>
@endsection
