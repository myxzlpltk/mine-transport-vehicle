<?php

namespace App\Rules;

use App\Models\Travel;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class TravelNotConflict implements Rule, DataAwareRule {

    /**
     * @var array
     */
    protected array $data = [];
    private string $message = "";

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $started_at = $this->data['started_at'];
        $ended_at = $this->data['ended_at'];
        $date_query = "((started_at BETWEEN '$started_at' AND '$ended_at') OR (ended_at BETWEEN '$started_at' AND '$ended_at'))";

        // Check if correlated driver is already assigned to another travel
        $travel_driver = Travel::query()
            ->where('driver_id', $this->data['driver_id'])
            ->whereRaw($date_query)
            ->get();

        if ($travel_driver->count() > 0) {
            $this->message = "Driver sudah ditugaskan ke perjalanan lain pada rentang waktu ini";
            return false;
        }

        // Check if correlated vehicle is already assigned to another travel
        $travel_driver = Travel::query()
            ->where('vehicle_id', $this->data['vehicle_id'])
            ->whereRaw($date_query)
            ->get();

        if ($travel_driver->count() > 0) {
            $this->message = "Kendaraan sudah ditugaskan ke perjalanan lain pada rentang waktu ini";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return $this->message;
    }

    /**
     * @param $data
     * @return TravelNotConflict|void
     */
    public function setData($data) {
        $this->data = $data;
    }
}
