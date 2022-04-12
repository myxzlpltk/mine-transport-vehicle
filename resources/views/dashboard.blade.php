@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kendaraan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_vehicles }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-pickup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Driver
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_drivers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Perjalanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_travels }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-route fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Permintaan Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pending_requests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-signature fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pemakaian Kendaraan
                        Bulan {{ now()->translatedFormat('F Y') }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="usage-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->role == 'validator')
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permintaan Pending</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kendaraan</th>
                                <th>Driver</th>
                                <th>Waktu Perjalanan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pending_reviews as $travel)
                                <tr>
                                    <td>{{ $pending_reviews->firstItem() + $loop->index }}</td>
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
                                        @can('update', $travel)
                                            <form action="{{ route('travels.accept', $travel) }}" onsubmit="return confirm('Apakah anda yakin?')"
                                                  method="POST" class="d-inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check fa-fw"></i>
                                                    <span>Terima</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('travels.reject', $travel) }}" onsubmit="return confirm('Apakah anda yakin?')"
                                                  method="POST" class="d-inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban fa-fw"></i>
                                                    <span>Terima</span>
                                                </button>
                                            </form>
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

                    {{ $pending_reviews->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            window.stokChart = new Chart(document.getElementById('usage-chart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: {!! $travels->pluck('label')->toJson() !!},
                    datasets: [
                        {
                            label: 'Jumlah Perjalanan',
                            backgroundColor: 'rgb(75, 192, 192, 0.2)',
                            borderColor: 'rgb(75, 192, 192)',
                            data: {!! $travels->pluck('data')->toJson() !!},
                            pointHitRadius: 10,
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: (value) => (value % 1 === 0) ? value : null
                            }
                        }]
                    },
                }
            });
        });
    </script>
@endsection
