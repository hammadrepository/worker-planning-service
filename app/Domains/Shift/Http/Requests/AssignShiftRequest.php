<?php

namespace App\Domains\Shift\Http\Requests;

use App\Domains\Shift\Enums\ShiftTypes;
use Carbon\Traits\Date;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignShiftRequest extends FormRequest
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
           'worker_id' => [
               'numeric',
               'required',
               'exists:users,id'
           ],
           'shift_id' => [
               'required',
               'exists:shifts,id'
           ],
           'date' => [
               'required',
               'date_format:Y-m-d',
               'after_or_equal:today'
           ],
       ];
    }
}
