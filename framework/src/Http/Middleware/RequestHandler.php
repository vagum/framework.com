<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [
        Authenticate::class,
        Success::class,
    ];

    public function handle(Request $request): Response
    {
        // Если нет middleware-классов для выполнения, вернуть ответ по умолчанию
        // Ответ должен был быть возвращен до того, как список станет пустым

        if (empty($this->middleware)) {
            return new Response('Server Error', 500);
        }

        // Получить следующий middleware-класс для выполнения
        /** @var MiddlewareInterface $middlewareClass */
        $middlewareClass = array_shift($this->middleware);

        // Создать новый экземпляр вызова процесса middleware на нем

        $response = (new $middlewareClass)->process($request, $this);

        return $response;
    }
}
