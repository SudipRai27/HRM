<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Chat\Entities\Chat;
use App\Events\NewMessage;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getChatView()
    {
        return view('chat::chat-view');
    }

    public function getChatContacts()
    {
    	$contacts = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Chat::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                        ->where('to', auth()->id())
                        ->where('read', false)
                        ->groupBy('from')
                        ->get();

        $contacts = $contacts->map(function($contact) use ($unreadIds) {                        
        
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;

        });
        

    	return response()->json($contacts);
    }

    public function getMessageFor($id)
    {
        //mark all messages  with selected contact as read
        Chat::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        $messages = Chat::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })->get();

    	return response()->json($messages);
    }

    public function send(Request $request)
    {
    	$message = Chat::create([
    		'from' => auth()->id(), 
    		'to' => $request->contact_id, 
    		'text' => $request->text
    		]);

        broadcast(new NewMessage($message));

    	return response()->json($message);
    }
}
