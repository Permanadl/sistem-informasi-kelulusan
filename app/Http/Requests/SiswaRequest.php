<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
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
            'nis' => ['required', 'max:10', Rule::unique('data_siswa', 'nis')->ignore($this->data_siswa)],
            'nisn' => ['required', 'max:10', Rule::unique('data_siswa', 'nisn')->ignore($this->data_siswa)],
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_ajaran' => 'required',
            'jurusan' => 'required'
        ];
    }
}
