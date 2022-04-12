<?php

namespace App\Http\Requests;

use App\Rules\TravelNotConflict;
use Illuminate\Foundation\Http\FormRequest;

class StoreTravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'started_at' => ['required', 'date', 'after:today', new TravelNotConflict],
            'ended_at' => ['required', 'date', 'after:today', 'after:started_at'],
        ];
    }
}
