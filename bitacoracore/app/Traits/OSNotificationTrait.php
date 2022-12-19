<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait OSNotificationTrait
{
    use BitacoraTrait;

    public function sendNotification($message)
    {
        if (!empty($message)) {

            $dataRaw = [
                "app_id" => $this->getOneSignalAppId(),
                "prority" => 10,
                "included_segments" => [
                    "SuperUsuarios"
                ],
                "headings" => [
                    "en" => "Bitacora Web",
                    "es" => "Bitacora Web"
                ],
                "isAnyWeb" => true,
                "contents" => [
                    "en" => $message,
                    "es" => $message
                ],
                "url" => "https=>//itsoft.mx",
                "big_picture" => "https=>//calimax.com.mx/wp-content/uploads/2020/04/Calimax-logo.png",
                "ios_attachments" => [
                    "id" => "https=>//calimax.com.mx/wp-content/uploads/2020/04/Calimax-logo.png"
                ],
                "name" => "INTERNAL_CAMPAIGN_NAME"
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
                "Authorization" => $this->getBasicAuth(),
                "Content-Type" => "application/json",
                "Accept" => "application/json"
            ])->timeout($timeout)->post($this->getOneSignalUri() . "/api/v1/notifications", $dataRaw);

            if ($response->json('recipients') > 0) {

                $data = [
                    "code" => 200,
                    "status" => "success",
                    "message" => "Se ha enviado a: " . $response->json('recipients') . " destinatarios.",
                ];
                $this->guardarEvento("Notificaciones OneSignal", "Se ha enviado Notificacion OS a SuperUser con el mensaje: " . $message);
            } else {
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

    public function getOneSignalAppId()
    {
        return env('OS_APP_ID');
    }

    public function getBasicAuth()
    {
        return "Basic ".env('OS_AUTH_ID');
    }

    public function getOneSignalUri() {
        return "https://onesignal.com";
    }
}
