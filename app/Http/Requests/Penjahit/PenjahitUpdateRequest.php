<?php

namespace App\Http\Requests\Penjahit;

use Illuminate\Foundation\Http\FormRequest;

class PenjahitUpdateRequest extends FormRequest
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
            'nama' => 'required',
            'no_hp' => 'required',
            'tanggal_lahir' => 'required',
            'no_rekening' => 'required',
            'bank' => 'required',
            'kodepos' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required'
        ];
    }
}
