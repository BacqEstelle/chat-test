<?php

namespace App\Http\Controllers;

use App\Repository\ConversationRepository;
use App\Http\Requests\StoreMessage;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    private $conversationRepository;
    private $auth;

    public function __construct(ConversationRepository $conversationRepository, AuthManager $auth)
    {
        $this->conversationRepository = $conversationRepository;
        $this->auth = $auth;
    }
    public function index()
    {

        return view('conversations.index', [
            'users' => $this->conversationRepository->getConversations($this->auth->user()->id)
        ]);
    }
    public function show(User $user)
    {


        return view('conversations.show', [
            'users' => $this->conversationRepository->getConversations($this->auth->user()->id),
            'user' => $user,
            'messages' => $this->conversationRepository->getMessagesFor($this->auth->user()->id, $user->id)->paginate(15)
        ]);
    }

    public function store(User $user, StoreMessage $request)
    {
        $this->conversationRepository->createMessage(
            $request->get('content'),
            $this->auth->user()->id,
            $user->id


        );
        return redirect(route('conversations.show',['user'=>$user->id]));
    }
}
