<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Chat;
use Illuminate\Support\Facades\Auth;
use Musonza\Chat\Models\Conversation;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ping()
    {
        return "pong";
    }

    public function index()
    {
        $conversations = Chat::conversations()->conversation->all();
        return response($conversations);
    }

    public function indexConversation(Conversation $conversation)
    {
        $messages = $conversation->messages;

        return view('chat', compact('messages', 'conversation'));
    }

    public function getConversationMessages(Conversation $conversation)
    {
        $messages = $conversation->messages;

        return response($messages);
    }

    public function sendMessage(Conversation $conversation, Request $request)
    {
        $message = Chat::message($request->message)
                  ->from($request->user())
                  ->to($conversation)
                  ->send();

        return redirect()->back();
    }

    public function store()
    {
        $participants = [auth()->user()->id];
        $conversation = Chat::createConversation($participants);

        return response($conversation);
    }

    public function participants($conversationId)
    {
        $participants = Chat::conversations()->getById($conversationId)->users;

        return response($participants);
    }

    public function join(Request $request, Conversation $conversation)
    {
        Chat::conversation($conversation)->addParticipants(auth()->user());
        return response('');
    }

    public function leaveConversation(Request $request, Conversation $conversation)
    {
        Chat::conversation($conversation)->removeParticipants(auth()->user());
        return response('');
    }

    public function getMessages(Request $request, Conversation $conversation)
    {
        $messages = Chat::conversation($conversation)->for(auth()->user())->getMessages();

        return response($messages);
    }

    public function deleteMessages(Conversation $conversation)
    {
        Chat::conversation($conversation)->for(auth()->user())->clear();
        return response('');
    }

//    public function sendMessage(Request $request, Conversation $conversation)
//    {
//        $user = User::find(1);
//
//        $message = Chat::message($request->message)
//                  ->from($user)
//                  ->to($conversation)
//                  ->send();
//
//      return response($message);
//    }
}
