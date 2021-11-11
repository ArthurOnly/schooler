<?php

namespace App\Http\Requests\Classrooom;

use Illuminate\Foundation\Http\FormRequest;

class ShowClassroomNOtas extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->can('notas classroom show') || auth()->user()->id == $this->classroom->teacher_id){
            return true;
        };
        return false;
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
