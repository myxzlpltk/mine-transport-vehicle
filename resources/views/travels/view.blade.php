@extends('layouts.app')

@section('title', "Informasi Perjalanan")

@section('actions')
    @can('update', $travel)
        <a href="{{ route('travels.edit', $travel) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-edit fa-fw"></i>
            <span>Edit</span>
        </a>
    @endcan
    @can('delete', $travel)
        <form action="{{ route('travels.destroy', $travel) }}" onsubmit="return confirm('Apakah anda yakin?')"
              method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash fa-fw"></i>
                <span>Hapus</span>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fa fa-info-circle fa-fw"></i>
                        <span>Informasi Perjalanan</span>
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>Nama Driver</th>
                            <td>
                                <a href="{{ route('drivers.show', $travel->driver) }}">{{ $travel->driver?->name }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <td>
                                <a href="{{ route('vehicles.show', $travel->vehicle) }}">{{ $travel->vehicle?->brand }} {{ $travel->vehicle?->model }}
                                    ({{ $travel->vehicle?->color }})</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Perjalanan</th>
                            <td>{{ $travel->started_at->translatedFormat('d F Y h:i') }}
                                - {{ $travel->ended_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span
                                    class="badge {{ $travel->status == \App\Enums\TravelStatus::Pending ? 'badge-primary' : ($travel->status == \App\Enums\TravelStatus::Validated ? 'badge-success' : 'badge-danger') }}">{{ strtoupper($travel->status->getValue()) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Divalidasi Pada</th>
                            <td>{{ $travel->validated_at ? $travel->validated_at->translatedFormat('d F Y h:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $travel->created_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diedit</th>
                            <td>{{ $travel->updated_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
