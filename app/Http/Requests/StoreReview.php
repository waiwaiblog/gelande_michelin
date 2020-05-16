<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
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
            'gelande_name' => 'required|max:50',
            'title' => 'required|max:50',
            'star' => 'required|integer',
            'comment' => 'required|min:10',
            'area_id' => 'required|integer',
            'user_id' => 'required|integer',

        ];
    }
}
