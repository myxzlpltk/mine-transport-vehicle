@extends('layouts.app')

@section('title', 'Edit Driver')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-clipboard-list fa-fw"></i>
                <span>Formulir</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('drivers.update', $driver) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Nama Driver
                        <x-required/>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                           value="{{ old('name', $driver->name) }}" placeholder="Budi Santoso" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="age">Umur Driver
                        <x-required/>
                    </label>
                    <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" id="age"
                           value="{{ old('age', $driver->age) }}" placeholder="25" min="18" step="1" required>
                    @error('age')
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
