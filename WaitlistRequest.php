<?php

namespace App\Http\Requests;

class WaitlistRequest extends FormRequest
{
    public function filters()
    {
        return [
            'email' => 'mb_strtolower',
        ];
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email:strict',
                'unique:subscribers'
            ],
        ];
    }
}
