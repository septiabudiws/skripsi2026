<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $kriteriaId = $this->route('kriteria');

        return [
            'kode' => [
                'required',
                'string',
                'max:10',
                Rule::unique('kriteria', 'kode_kriteria')->ignore($kriteriaId),
            ],
            'kriteria' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0',
            'tipe' => 'required|in:benefit,cost',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required' => 'Kode kriteria (misal: C1) wajib diisi.',
            'kode.unique'   => 'Kode kriteria ini sudah dipakai, gunakan kode lain.',
            'kode.max'      => 'Kode kriteria maksimal 10 karakter.',
            'kriteria.required'      => 'Nama kriteria wajib diisi.',
            'bobot.required'         => 'Bobot wajib diisi.',
            'bobot.numeric'          => 'Bobot harus berupa angka.',
            'tipe.required'          => 'Tipe kriteria wajib dipilih.',
            'tipe.in'                => 'Pilihan tipe (Benefit/Cost) tidak valid.',
        ];
    }
}
