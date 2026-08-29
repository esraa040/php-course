<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestChatController extends Controller
{
    /**
     * عرض صفحة الشات
     */
    public function index()
    {
        return view('chat.index');
    }

    /**
     * معالجة الرسائل وإرسالها لـ OpenAI
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API key is not configured.'
            ], 500);
        }

        // إرسال الطلب إلى OpenAI API باستخدام نموذج gpt-4o-mini أو gpt-3.5-turbo
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini', // يمكنك تغييره إلى gpt-3.5-turbo إذا أردت
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $request->message],
            ],
        ]);

        if ($response->successful()) {
            $reply = $response->json()['choices'][0]['message']['content'] ?? 'لم يتم استلام رد.';
            return response()->json(['reply' => $reply]);
        }

        return response()->json([
            'error' => 'حدث خطأ في الاتصال بالخدمة: ' . ($response->json()['error']['message'] ?? 'خطأ غير معروف')
        ], 500);
    }
}
