<?php

namespace App\Http\Requests\Audit;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Audit\ReffActivity;

class CreateReffActivityRequest extends FormRequest
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
        return ReffActivity::$rules;
    }
}
