<?php

namespace App\Exports;

use App\Models\Travel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TravelExport implements FromCollection, WithHeadings, WithMapping {

    protected $startedAt;
    protected $endedAt;
    protected $counter = 1;

    public function __construct($startedAt, $endedAt) {
        $this->startedAt = Carbon::parse($startedAt);
        $this->endedAt = Carbon::parse($endedAt);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Travel::query()
            ->with(['driver', 'vehicle'])
            ->whereBetween('started_at', [$this->startedAt, $this->endedAt])
            ->orWhereBetween('ended_at', [$this->startedAt, $this->endedAt])
            ->get();
    }

    public function headings(): array {
        return ['No', 'Driver', 'Kendaraan', 'Waktu Mulai', 'Waktu Akhir', 'Status', 'Tanggal Validasi'];
    }

    public function map($row): array {
        return [
            $this->counter++,
            $row->driver->name,
            $row->vehicle->brand." ".$row->vehicle->model,
            $row->started_at->translatedFormat('d/m/Y H:i'),
            $row->ended_at->translatedFormat('d/m/Y H:i'),
            $row->status->getValue(),
            $row->validated_at ? $row->validated_at->translatedFormat('d/m/Y H:i') : '',
        ];
    }
}
