<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatController extends Controller
{
    private $apiKey = 'AIzaSyCaTpnlSG7LBwbe3r2Ih-x1lEEYlA9aNnw';  
    private $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent';

    public function sendMessage(Request $request)
    {
        try {
            $userMessage = $request->input('message');

            $client = new Client();
            $response = $client->post($this->baseUrl . '?key=' . $this->apiKey, [
                'json' => [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $userMessage]
                            ]
                        ]
                    ],
                    'systemInstruction' => [
                        'role' => 'user',
                        'parts' => [
                            [
                                'text' => "Kamu adalah JobFinder AI Assistant, asisten virtual untuk pencarian kerja remote. 
                                        Jawablah secara singkat dan langsung ke inti (maksimal 2 kalimat). 
                                        Jika pertanyaan di luar topik pencarian kerja, balas dengan 'Maaf, saya hanya dapat membantu dalam hal terkait pencarian kerja remote.'"
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7, // Kontrol kreativitas jawaban
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 100, // Batas jawaban agar tidak terlalu panjang
                        'responseMimeType' => 'text/plain'
                    ]
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            $aiResponse = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, terjadi kesalahan dalam memproses pesan.';

            return response()->json([
                'success' => true,
                'message' => $aiResponse
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
