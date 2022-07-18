<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

trait UpdateMessageTrait
{

    public function updateMessage(Request $request, $message, $messageType)
    {
        $request->session()->put('message', $message);
        $request->session()->put('messageType', $messageType);
    }

    public function updateFailMessage(Request $request, $message)
    {
        $this->updateMessage($request, $message, 'danger');
    }

    public function updateSuccessMessage(Request $request, $message)
    {
        $this->updateMessage($request, $message, 'success');
    }
}
