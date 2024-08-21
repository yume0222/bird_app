<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'self_introduction' => ['string', 'max:255'],
            'gender' => ['integer', 'max:255'],
            'age' => ['integer', 'max:255'],
            'favorite_bird' => ['string', 'max:255'],
            'my_pet' => ['string', 'max:255'],
            'bird_watching' => ['string', 'max:255'],
            // 'image_path' => [''],
            'prefecture_id' => [''],
            //'bird_picture_id' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
