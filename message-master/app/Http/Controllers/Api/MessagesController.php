<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageCollection;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Http\Resources\Message as MessageResource ;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sortColumn, '-');

        return new MessageCollection(Message::orderBy($sortColumn, $sortDirection)->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Message::create([
            'chat_id' => $request->input('chat_id'),
            'sender_id' => $request->input('sender_id'),
            'message' => Crypt::encrypt($request->input('message')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Message::findOrfail($id);

        return new MessageResource(Message::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd();
        //$message = $request->input();
        $messageId = Message::findOrfail($id);
        $messageId->update([
            'message' => Crypt::encrypt($request->only('message'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$id = $request->input('id');
        return Message::findOrfail($id)->delete();
        return redirect()->route('api/messages/index');
    }
}
