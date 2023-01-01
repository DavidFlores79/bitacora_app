<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait OSNotificationTrait
{
    use BitacoraTrait;

    public function sendNotification($message)
    {
        if ($message) {

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
                "url" => "https://mibitacora.enlacetecnologias.mx",
                "name" => "INTERNAL_CAMPAIGN_NAME"
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Es mandatorio enviar un mensaje.',
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
                $this->guardarEvento("Notificaciones OneSignal", "ha notificado en la Aplicación Web que ha iniciado sesión.");
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
