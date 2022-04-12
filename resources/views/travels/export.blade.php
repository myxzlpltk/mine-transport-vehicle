@extends('layouts.app')

@section('title', 'Export Data Perjalanan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-clipboard-list fa-fw"></i>
                <span>Formulir</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('travels.export') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="started_at">Tanggal Mulai
                                <x-required/>
                            </label>
                            <input type="date" class="form-control @error('started_at') is-invalid @enderror" name="started_at" id="started_at"
                                   value="{{ old('started_at') }}" placeholder="Mitsubishi" required>
                            @error('started_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ended_at">Tanggal Berakhir
                                <x-required/>
                            </label>
                            <input type="date" class="form-control @error('ended_at') is-invalid @enderror" name="ended_at" id="ended_at"
                                   value="{{ old('ended_at') }}" placeholder="FZ 4928" required>
                            @error('ended_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save fa-fw"></i>
                    <span>Simpan</span>
                </button>
            </form>
        </div>
    </div>
@endsection
