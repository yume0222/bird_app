<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // //post
            // 'post.body' => 'required|string|min:1|max:200',
            // // 'post.prefecture' => 'required',
            // //pet_bird_post
            // 'pet_bird_post.type' => 'required|string|min:1|max:50',
            // 'pet_bird_post.personality' => 'required|string|min:1|max:100',
            // 'pet_bird_post.special_skil' => 'required|string|min:1|max:100',
            // //wild_bird_post
            // 'wild_bird_post.type' => 'required|string|min:1|max:50',
            // 'wild_bird_post.location_detail' => 'required|string|min:1|max:100',
            // 'wild_bird_post.prefecture' => 'required',
            // //event_post
            // 'event_post.name' => 'required|string|min:1|max:50',
            // 'event_post.start_date' => 'required',
            // 'event_post.location_detail' => 'required|string|min:1|max:100',
            // 'event_post.prefecture' => 'required',
            // //lost_bird_post
            // 'lost_bird_post.discovery_date' => 'required',
            // 'lost_bird_post.text' => 'required',
            // 'lost_bird_post.location_detail' => 'required|string|min:1|max:100',
            // 'lost_bird_post.characteristics' => 'required|string|min:1|max:100',
            // 'lost_bird_post.type' => 'required|string|min:1|max:50',
            // 'lost_bird_post.prefecture' => 'required',
        ];
    }
}
