<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\P2PChatService;
use App\Services\UserService;
use Illuminate\Http\Request;


class P2PChatController extends Controller
{
    /**
     * @var \App\Services\P2PChatService
     */
    protected $p2pChatService;

    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * P2PChatController constructor.
     *
     * @param \App\Services\P2PChatService $p2pChatService
     */
    public function __construct(P2PChatService $p2pChatService, UserService $userService)
    {
        $this->p2pChatService = $p2pChatService;
        $this->userService = $userService;
    }

    public function getChats(Request $request)
    {
        return $this->successResponse($this->p2pChatService->getChats($request->all()));
    }

    public function getChat($id)
    {
        return $this->successResponse($this->p2pChatService->getChat($id));
    }

    public function createChat(Request $request)
    {
        $params = $request->all();
        $recipient = $this->successResponse($this->userService->fetchUser($params['recipient_id']));
        $user = json_decode($recipient->content())->data;
        $chatParams = [
            'recipient_id' => $user->id,
            'recipient_name' => implode(' ', [$user->name, $user->surname]),
        ];

        return $this->successResponse($this->p2pChatService->createChat($chatParams));
    }

    public function createMessage(Request $request, $id)
    {
        return $this->successResponse($this->p2pChatService->createMessage($id, $request->all()));
    }

}
