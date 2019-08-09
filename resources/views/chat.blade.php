@extends('layouts.app')

@section('content')

    <div id="app">
        <h1>Chatroom</h1>
        <chat-log :messages="messages" style="max-height: 70vh; overflow-y: scroll; border: 1px solid grey;" id="chat-log"></chat-log>
        <chat-composer v-on:messagesent="addMessage"></chat-composer>
    </div>

    <script>
        var chat = document.querySelector('#chat-log');
        chat.scrollTop = chat.scrollHeight - chat.clientHeight;
    </script>
@endsection
    
