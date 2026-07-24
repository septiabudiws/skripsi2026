<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriRequest extends FormRequest
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
        $kategoriId = $this->route('kategori');

        return [
            'nama_kategori' => [
                'required',
                'max:50',
                // Pengecekan unique, tapi kecualikan ID yang sedang diedit
                Rule::unique('kategori', 'nama_kategori')->ignore($kategoriId)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.unique'   => 'Nama kategori ini sudah ada, gunakan nama lain.',
            'nama_kategori.max'      => 'Nama kategori tidak boleh lebih dari 50 karakter.',
        ];
    }
}
