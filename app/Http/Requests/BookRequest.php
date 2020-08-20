<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\AuthorType;

class BookRequest extends FormRequest
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
            'authors' => 'required|array',
            'authors.*.id' => 'required|exists:authors,id',
            'authors.*.type' => [
                'required',
                Rule::in(AuthorType::getKeys()),
            ],
            'categories' => 'required|array|exists:categories,id',
            "title" => 'required|unique:books',
            "original_title" => 'required|unique:books',
            "edition_language" => 'required',
            "slug" => 'required',
            "description" => 'required',
            "isbn" => 'required'
        ];
    }
}
