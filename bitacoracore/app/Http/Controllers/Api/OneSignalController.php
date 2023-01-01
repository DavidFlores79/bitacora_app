<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\BitacoraTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OneSignalController extends Controller
{
    use BitacoraTrait;

    public function getPlayerIds() {

        $recipients = User::whereNotNull('device_token')->select('nickname', 'nombre', 'apellido', 'device_token')->get();

        if (count($recipients) > 0) {
                    
            $data = [
                "code" => 200,
                "status" => "success",
                "message" => "",
                "destinatarios" => $recipients
            ];

        }else{
            $data = [
                "code" => 400,
                "status" => "error",
                "message" => "No se encontraron usuarios conectados."
            ];
        }
        return response()->json($data, $data["code"]);
    }

    public function sendNotification(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
            'recipients' => 'required|exists:users,device_token',
        ];
        $this->validate($request, $rules);

        $recipients = $request->input('recipients');
        $mensaje = $request->input('body');


        if (count($recipients) > 0) {

            $dataRaw = [
                "app_id"=> $this->getOneSignalAppId(),
                "prority"=> 10,
                "android_sound"=> "notification",
                "include_player_ids"=> $recipients,
                "headings"=> [
                    "en"=> "🔔 ".$request->input('title')." 🔔",
                    "es"=> "🔔 ".$request->input('title')." 🔔"
                ],
                "contents"=> [
                    "en"=> $mensaje." 🧑‍💻",
                    "es"=> $mensaje." 🧑‍💻"
                ],
                "url"=> "https://mibitacora.enlacetecnologias.mx",
                "big_picture"=> "https://mibitacora.enlacetecnologias.mx/assets/img/brand/logo.svg",
                "ios_attachments"=> [ "id" => "https://mibitacora.enlacetecnologias.mx/assets/img/brand/logo.svg"]
            ];
	
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Ningún usuario está conectado actualmente al Sistema de Notificaciones (OS). Intente más tarde.',
            ];
        }


        $timeout = 15;

        try {
            $response = Http::withHeaders([
                "Authorization" => $this->getOneSignalApiKey(),
                "Content-Type" => "application/json",
                "Accept" => "application/json"
                ])->timeout($timeout)->post($this->getOneSignalUri()."/v1/notifications", $dataRaw);

                if($response->json('recipients') > 0){
                    
                    $data = [
                        "code" => 200,
                        "status" => "success",
                        "message" => "Se ha enviado a: ".$response->json('recipients')." destinatarios.",
                    ];
                    $this->guardarEvento("Notificaciones OneSignal", "Se ha enviado a: ".count($recipients)." destinatarios el mensaje: ".$request->input('body'));
    
                }else{
                    $data = [
                        "code" => 400,
                        "status" => "error",
                        "message" => $response->json("errors")
                    ];
                    $this->guardarEvento("Notificaciones OneSignal", "ocurrió error al enviar mensaje.", "S/D", false);
                }
                return response()->json($data, $data["code"]);

        } catch (\Throwable $th) {
            $data = [
                "code" => 404,
                "status" => "error",
                "message" => "Error al intentar enviar el mensaje. Verificar...",
            ];
            return response()->json($data, $data["code"]);
        }  

        return response()->json($data, $data['code']);
    }

}
