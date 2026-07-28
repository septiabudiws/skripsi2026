<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
        return [
            'metode_pembayaran_id' => 'required|exists:metode_pembayaran,id',
            'nama_customer'        => 'nullable|string|max:255',
            'total_qty'            => 'required|integer|min:1',
            'subtotal'             => 'required|integer|min:1',
            'bayar'                => 'required|integer|min:0',
            'kembalian'            => 'required|integer',
            'cart'                 => 'required|array|min:1', // Wajib ada isinya minimal 1 item
            'cart.*.menu_id'       => 'required|exists:menu,id',
            'cart.*.qty'           => 'required|integer|min:1',
            'cart.*.harga_satuan'  => 'required|integer|min:0',
            'cart.*.subtotal'      => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'cart.required' => 'Keranjang pesanan masih kosong!',
            'bayar.min'     => 'Nominal pembayaran tidak valid!',
        ];
    }
}
