<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mensajes;

use Illuminate\Support\Facades\Auth;
use App\Events\TestEvent;
@session_start();
class ChatsController extends Controller
{
/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
  //return view('chat');
  //event(new TestEvent('broadcast enviado'));
  //return view('logistica.chat');
}

/**
 * Fetch all messages
 *
 * @return Message
 */
public function fetchMessages()
{
  return Message::with('user')->get();
}

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
{
  $user = Auth::user();

 // $message = $user->messages()->create([
 //   'message' => $request->input('mensaje')
 // ]);
  $mensajes= new Mensajes();
  $mensajes->id_usuario = Auth::user()->id;
  $mensajes->id_delivery = $request->id_delivery;
  $mensajes->id_venta    = $request->id_venta;
  event(new TestEvent($request->input('mensaje')));
  return ['status' => 'Mensaje Enviado'];
}
}