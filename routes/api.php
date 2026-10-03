<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentGatewayApiController;

/*
|--------------------------------------------------------------------------
| SelfTyping API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Android SMS Gateway Webhook
    Route::post('/sms/webhook', [PaymentGatewayApiController::class, 'receiveSmsWebhook'])->name('api.sms.webhook');
    Route::get('/sms/status', [PaymentGatewayApiController::class, 'getGatewayStatus'])->name('api.sms.status');

    // Instant Payment Verification (Web/App)
    Route::middleware('auth:sanctum')->post('/payment/verify-instant', [PaymentGatewayApiController::class, 'verifyInstantPayment'])->name('api.payment.verify');
});
