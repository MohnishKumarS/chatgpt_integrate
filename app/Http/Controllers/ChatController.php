<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatGPTService;

class ChatController extends Controller
{

    protected $chatService;

    public function __construct(ChatGPTService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function index(){
        return view('index');
    }


    public function send(Request $request)
    {
        $message = $request->input('message');
        $response = $this->chatService->sendMessage($message);

        // Optionally save the response here

        return response()->json(['response' => $response]);
        // return response()->stream(function () use ($response) {
        //     foreach ($response as $chunk) {
        //         echo "data: " . $chunk . "\n\n"; // Send each chunk as data
        //         flush(); // Ensure the chunk is sent to the browser
        //     }
        // }, 200, [
        //     'Content-Type' => 'text/event-stream',
        //     'Cache-Control' => 'no-cache',
        //     'Connection' => 'keep-alive',
        //     'Transfer-Encoding' => 'chunked',
        // ]);
    }
}
