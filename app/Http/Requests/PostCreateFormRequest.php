<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateFormRequest extends FormRequest
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
            'caption' => 'required',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];

        // $rules = [
        //     'caption' => 'required'
        // ];
        // $images = count($this->input('images'));
        // foreach(range(0, $images) as $index) {
        //     $rules['images.' . $index] = 'image|mimes:png,jpg';
        // }

        // return $rules;

        // $rules = [
        //     'name' => 'required'
        // ];
        // $photos = count($this->input('photos'));
        // foreach(range(0, $photos) as $index) {
        //     $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        // }

        // return $rules;
    }
}
