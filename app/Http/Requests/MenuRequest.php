<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
        $menuId = $this->route('menu');

        return [
            'kategori_id' => [
                'required',
                'exists:kategori,id'
            ],
            'nama_menu' => [
                'required',
                'max:200',
                Rule::unique('menu', 'nama')->ignore($menuId)
            ],
            'hpp' => [
                'required',
                'numeric',
                'min:0'
            ],
            'harga' => [
                'required',
                'numeric',
                'min:0'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih!',
            'kategori_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'nama_menu.required'   => 'Nama menu wajib diisi!',
            'nama_menu.unique'     => 'Nama menu ini sudah ada, gunakan nama lain.',
            'nama_menu.max'        => 'Nama menu tidak boleh lebih dari 200 karakter.',
            'hpp.required'         => 'HPP wajib diisi!',
            'hpp.numeric'          => 'HPP harus berupa angka.',
            'hpp.min'              => 'HPP tidak boleh kurang dari 0.',
            'harga.required'       => 'Harga jual wajib diisi!',
            'harga.numeric'        => 'Harga jual harus berupa angka.',
            'harga.min'            => 'Harga jual tidak boleh kurang dari 0.',
        ];
    }
}
