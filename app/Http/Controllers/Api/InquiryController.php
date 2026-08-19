<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreInquiryRequest;
use App\Mail\NewInquiryNotification;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/inquiries',
    summary: 'Submit a contact inquiry',
    description: 'Stores a contact form submission. Rate limited to 10 requests per minute.',
    tags: ['Inquiries'],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: '#/components/schemas/StoreInquiryRequest')
    ),
    responses: [
        new OA\Response(response: 201, description: 'Inquiry submitted', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Inquiry submitted successfully.'),
            new OA\Property(property: 'data', type: 'object', example: ['id' => 6]),
        ])),
        new OA\Response(response: 422, description: 'Validation error', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
            new OA\Property(property: 'errors', type: 'object', example: ['email' => ['The email field is required.']]),
        ])),
        new OA\Response(response: 429, description: 'Too many attempts', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'Too Many Attempts.'),
        ])),
    ]
)]
class InquiryController extends BaseApiController
{
    public function store(StoreInquiryRequest $request): JsonResponse
    {
        $inquiry = Inquiry::create([
            ...$request->validated(),
            'status'     => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Notify admin via email
        try {
            Mail::to(env('ADMIN_NOTIFICATION_EMAIL', config('mail.from.address')))
                ->send(new NewInquiryNotification($inquiry));
        } catch (\Throwable $e) {
            Log::error('Failed to send new inquiry notification email', [
                'inquiry_id' => $inquiry->id,
                'error'      => $e->getMessage(),
            ]);
        }

        return $this->success(
            ['id' => $inquiry->id],
            'Inquiry submitted successfully.',
            status: 201,
        );
    }
}
