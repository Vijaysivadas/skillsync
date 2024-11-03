<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class LlamaApiService
{
    public function llama($prompt,$sys_prompt)
    {
        $authToken ="yV2PHeux09E2GAic_dLk6sUv9lqeTClDHBP4GfPO";
        $accountId = "94467fb0e27f5d91cee7fdc6d7b984e6";
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$authToken}",
        ])->post("https://api.cloudflare.com/client/v4/accounts/{$accountId}/ai/run/@cf/meta/llama-3.1-70b-instruct", [
            'messages' => [
                ['role' => 'system', 'content' => $sys_prompt],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Failed to retrieve AI response from Cloudflare',
                'status' => $response->status(),
                'body' => $response->body(),
            ], $response->status());
        }
    }
}
