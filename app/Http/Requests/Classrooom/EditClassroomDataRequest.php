<?php

namespace App\Http\Requests\Classrooom;

use Illuminate\Foundation\Http\FormRequest;

class EditClassroomDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->can('notas classroom') || auth()->user()->id == $this->classroom->teacher_id){
            return true;
        };
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
