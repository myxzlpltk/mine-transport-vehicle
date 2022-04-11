<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::in(Vehicle::$types)],
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'year' => 'required|date_format:Y|before:today',
            'plate' => 'required|string|max:255',
        ];
    }
}
