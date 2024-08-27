<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{


    public function index()
    {

        $messages = Message::all();


        return response()->json($messages, 200);
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si el correo es válido enviando un correo de confirmación
        $emailValid = $this->verifyEmail($request->email);
        if (!$emailValid) {
            return response()->json(['error' => 'El correo electrónico no es válido.'], 400);
        }

        // Guardar el mensaje en la base de datos
        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json(['success' => '¡Mensaje enviado correctamente!'], 200);
    }

    private function verifyEmail($email)
    {
        // Enviar un correo de verificación y verificar si llega
        // Aquí deberías implementar un servicio de verificación de correo electrónico
        // Como alternativa, puedes implementar tu propia lógica o usar un servicio externo
        // En este ejemplo, simplemente retornaremos true para continuar
        return true;
    }

    public function destroy($id)
    {
        // Buscar el mensaje por ID
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Mensaje no encontrado.'], 404);
        }

        // Eliminar el mensaje
        $message->delete();

        return response()->json(['success' => 'Mensaje eliminado correctamente.'], 200);
    }
}
