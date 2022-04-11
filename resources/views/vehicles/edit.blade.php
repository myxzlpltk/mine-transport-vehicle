@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-clipboard-list fa-fw"></i>
                <span>Formulir</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="type">Jenis Kendaraan <x-required/></label>
                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                        @foreach(\App\Models\Vehicle::$types as $type)
                            <option value="{{ $type }}" @if(old('type', $vehicle->type) == $type) selected @endif>{{ ucwords($type) }}</option>
                        @endforeach
                    </select>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brand">Merk Kendaraan
                        <x-required/>
                    </label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" id="brand"
                           value="{{ old('brand', $vehicle->brand) }}" placeholder="Mitsubishi" required>
                    @error('brand')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="model">Model Kendaraan
                        <x-required/>
                    </label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" id="model"
                           value="{{ old('model', $vehicle->model) }}" placeholder="FZ 4928" required>
                    @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color">Warna Kendaraan
                        <x-required/>
                    </label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color"
                           value="{{ old('color', $vehicle->color) }}" placeholder="Hitam" required>
                    @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year">Tahun Kendaraan
                        <x-required/>
                    </label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year"
                           value="{{ old('year', $vehicle->year) }}" placeholder="{{ date('Y') - 10 }}" min="1990" max="{{ date('Y') }}" step="1" required>
                    @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="plate">Plat Nomor Kendaraan
                        <x-required/>
                    </label>
                    <input type="text" class="form-control @error('plate') is-invalid @enderror" name="plate" id="plate"
                           value="{{ old('plate', $vehicle->plate) }}" placeholder="N 199 A" required>
                    @error('plate')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save fa-fw"></i>
                    <span>Simpan</span>
                </button>
            </form>
        </div>
    </div>
@endsection
