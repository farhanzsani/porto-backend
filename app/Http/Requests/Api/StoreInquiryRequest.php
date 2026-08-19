<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StoreInquiryRequest',
    description: 'Contact form submission',
    required: ['name', 'email', 'message'],
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'John Anderson'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@company.com'),
        new OA\Property(property: 'message', type: 'string', example: 'Hello, we would like to discuss a project.'),
    ]
)]
class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }
}