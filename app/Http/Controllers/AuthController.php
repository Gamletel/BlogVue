<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Auth API",
 *     description="API для управления аутентификацией пользователей",
 *     @OA\Contact(
 *         email="gamletel@list.ru"
 *     ),
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="Методы для аутентификации"
 * )
 */
class AuthController extends Controller
{

    public function __construct(private readonly AuthService $authService)
    {
    }

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"Auth"},
     *     summary="Регистрация нового пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="avatar", type="string", example="image.png"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="Пользователь успешно зарегистрирован",
     *          @OA\JsonContent(
     *              @OA\Property(property="user", type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="name", type="string", example="John Doe"),
     *                  @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                  @OA\Property(property="avatar", type="string", example="https://example.com/avatar.jpg")
     *              ),
     *              @OA\Property(property="access_token", type="string", example="access_token_value"),
     *              @OA\Property(property="token_type", type="string", example="Bearer")
     *          )
     *      ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации"
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->authService->register($request->validated()));
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Auth"},
     *     summary="Выход из системы",
     *     description="Удаление токена и выход из системы.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный выход",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="logout success")
     *         )
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->all());

        return response()->json(['message' => 'logout success']);
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="Авторизация пользователя",
     *     description="Вход в систему с предоставлением email и пароля.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="remember", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *           description="Успешная авторизация",
     *           @OA\JsonContent(
     *               @OA\Property(property="user", type="object",
     *                   @OA\Property(property="id", type="integer", example=1),
     *                   @OA\Property(property="name", type="string", example="John Doe"),
     *                   @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                   @OA\Property(property="avatar", type="string", example="https://example.com/avatar.jpg")
     *               ),
     *               @OA\Property(property="access_token", type="string", example="access_token_value"),
     *               @OA\Property(property="token_type", type="string", example="Bearer")
     *           )
     *       ),
     *     @OA\Response(
     *         response=401,
     *         description="Ошибка авторизации"
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->all());

        if (!$result) {
            return response()->json(['message' => 'login failed'], 401);
        }

        return response()->json([
            'message' => 'Auth success',
            'user' => $result['user'],
            'access_token' => $result['access_token'],
            'token_type' => $result['token_type'],
        ]);
    }
}
