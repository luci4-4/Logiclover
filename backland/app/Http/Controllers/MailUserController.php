<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\MailUser;
use App\Mail\RegistrationEmail;
use App\Services\MailUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;



class MailUserController extends Controller
{
    protected $mailUserService;

    public function __construct(MailUserService $mailUserService)
    {
        $this->mailUserService = $mailUserService;
    }

    /**
     * Регистрация на рассылку и отправка подтверждения
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(SubscribeRequest $request)
    {
        $email = $request->input('email');

        try {
            $tempUser = new MailUser(['email' => $email]);

            Mail::to($email)->send(new RegistrationEmail($tempUser));

            $user = $this->mailUserService->registerUser($email);

            Log::info('Успешная регистрация', [
                'user_id' => $user->id,
                'email' => $email
            ]);

            return response()->json([
                'message' => "Успешная регистрация на подписку {$user->email}"
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Добавляем детальное логирование
            Log::error('Детальная информация об ошибке:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'email' => $email,
                'class' => get_class($e)
            ]);

            // Временно возвращаем детали ошибки в ответе
            return response()->json([
                'message' => 'Произошла ошибка при отправке рассылки',
                'debug_info' => [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
