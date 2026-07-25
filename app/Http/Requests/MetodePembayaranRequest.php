<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MetodePembayaranRequest extends FormRequest
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
        $metodeId = $this->route('metode');

        return [
            'metode' => 'required|string|max:255',
            Rule::unique('metode_pembayaran', 'nama_metode')->ignore($metodeId),
        ];
    }

    public function messages(): array
    {
        return [
            'metode.required' => 'Nama metode pembayaran wajib diisi!',
            'metode.string' => 'Format nama metode tidak valid.',
            'metode.max' => 'Nama metode maksimal 255 karakter.',
        ];
    }
}
