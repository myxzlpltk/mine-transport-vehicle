@extends('layouts.app')

@section('title', 'Permintaan Perjalanan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-clipboard-list fa-fw"></i>
                <span>Formulir</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('travels.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="driver_id">Pilih Driver <x-required/></label>
                    <select class="form-control @error('driver_id') is-invalid @enderror" name="driver_id" id="driver_id">
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" @if(old('driver_id') == $driver->id) selected @endif>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                    @error('driver_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vehicle_id">Pilih Kendaraan <x-required/></label>
                    <select class="form-control @error('vehicle_id') is-invalid @enderror" name="vehicle_id" id="vehicle_id">
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @if(old('vehicle_id') == $vehicle->id) selected @endif>{{ $vehicle->brand }} {{ $vehicle->model }}</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="started_at">Tanggal Mulai
                        <x-required/>
                    </label>
                    <input type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" name="started_at" id="started_at"
                           value="{{ old('started_at') }}" placeholder="Mitsubishi" required>
                    @error('started_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ended_at">Tanggal Berakhir
                        <x-required/>
                    </label>
                    <input type="datetime-local" class="form-control @error('ended_at') is-invalid @enderror" name="ended_at" id="ended_at"
                           value="{{ old('ended_at') }}" placeholder="FZ 4928" required>
                    @error('ended_at')
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
