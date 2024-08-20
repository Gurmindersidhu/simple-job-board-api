<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest as BaseRequest;

class UpdatejobsRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'salary' => 'required'
        ];
    }
}
