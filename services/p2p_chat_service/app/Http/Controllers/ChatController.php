<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Services;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class ChatController extends Controller
{
    public function getChats(Request $request)
    {
        $chats = Chat::all();
        return $this->successResponse($chats);
    }

    public function getChat($id)
    {
        $chat = Chat::find($id);
        $chat->messages = Message::where('chat_id', $id)->get();
        return $this->successResponse($chat);
    }

    public function createChat(Request $request)
    {
        try {
            $rules = [
                'recipient_id' => 'required|integer',
                'recipient_name' => 'required|string',
            ];
            $this->validate($request, $rules);
            $params = $request->all();
            /** @var Chat $chat */
            $chat = Chat::create([
                'sender_id' => $request->user->id,
                'recipient_id' => $params['recipient_id'],
                'sender_name' => implode(' ', [$request->user->name, $request->user->surname]),
                'recipient_name' => $params['recipient_name'],
            ]);
            return $this->successResponse($chat);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function createMessage(Request $request, $id)
    {
        try {
            $rules = [
                'message' => 'required|string',
            ];
            $this->validate($request, $rules);
            $params = $request->all();
            $message = Message::create([
                'chat_id' => $id,
                'sender_id' => $request->user->id,
                'message' => $params['message'],
            ]);
            return $this->successResponse($message);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), Response::HTTP_BAD_REQUEST);
        }
    }
}
