<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class MessageController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'to' => 'required',
        ]);

        $message = new Message();
        $message->text = $request->text;
        $message->to = $request->to;
        $message->from = Auth::user()->id;

        $message->save();

        MessageSent::dispatch($message);

        return response()->json([
            'message' => $message->load('from')
        ], status: 200);
    }

    public function index()
    {
        $messages = Message::where(function ($query) {
            $query->where('from', Auth::user()->id);
            $query->where('to', request('to'));
        })->orWhere(function ($query) {
            $query->where('from', request('to'));
            $query->where('to', Auth::user()->id);
        })->get();
        // return $messages;
        return response()->json([
            'messages' => $messages->load('from', 'to'),
            'crrunt' => Auth::user()->id
        ], 200);
    }
}
