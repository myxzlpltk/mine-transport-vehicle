@extends('layouts.app')

@section('title', $driver->name)

@section('actions')
    @can('update', $driver)
        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-edit fa-fw"></i>
            <span>Edit</span>
        </a>
    @endcan
    @can('delete', $driver)
        <form action="{{ route('drivers.destroy', $driver) }}" onsubmit="return confirm('Apakah anda yakin?')"
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
                            <th>Nama</th>
                            <td>{{ $driver->name }}</td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>{{ $driver->age }} Tahun</td>
                        </tr>
                        <tr>
                            <th>Total Perjalanan</th>
                            <td>{{ $driver->travels_count }} Perjalanan</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $driver->created_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diedit</th>
                            <td>{{ $driver->updated_at->translatedFormat('d F Y h:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
