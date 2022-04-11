@extends('layouts.app')

@section('title', $vehicle->name)

@section('actions')
    @can('update', $vehicle)
        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-edit fa-fw"></i>
            <span>Edit</span>
        </a>
    @endcan
    @can('delete', $vehicle)
        <form action="{{ route('vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Apakah anda yakin?')"
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
                        <span>Informasi Driver</span>
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th>Tipe Kendaraan</th>
                            <td>{{ ucwords($vehicle->type) }}</td>
                        </tr>
                        <tr>
                            <th>Merk Kendaraan</th>
                            <td>{{ $vehicle->brand }}</td>
                        </tr>
                        <tr>
                            <th>Model Kendaraan</th>
                            <td>{{ $vehicle->model }}</td>
                        </tr>
                        <tr>
                            <th>Warna Kendaraan</th>
                            <td>{{ $vehicle->color }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Kendaraan</th>
                            <td>{{ $vehicle->year }}</td>
                        </tr>
                        <tr>
                            <th>Plat Nomor Kendaraan</th>
                            <td>{{ $vehicle->plate }}</td>
                        </tr>
                        <tr>
                            <th>Total Perjalanan</th>
                            <td>{{ $vehicle->travels_count }} Perjalanan</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $vehicle->created_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diedit</th>
                            <td>{{ $vehicle->updated_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
