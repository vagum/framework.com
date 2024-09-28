<?php

namespace Somecode\Framework\Http\Middleware;

use Psr\Container\ContainerInterface;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [
        ExtractRouteInfo::class,
        StartSession::class,
        Authenticate::class,
        RouterDispatch::class,
    ];

    public function __construct(
        private ContainerInterface $container
    ) {}

    public function handle(Request $request): Response
    {
        // Если нет middleware-классов для выполнения, вернуть ответ по умолчанию
        // Ответ должен был быть возвращен до того, как список станет пустым

        if (empty($this->middleware)) {
            return new Response('Server Error', 500);
        }

        // Получить следующий middleware-класс для выполнения
        $middlewareClass = array_shift($this->middleware);

        // Создать новый экземпляр вызова процесса middleware на нем

        $middleware = $this->container->get($middlewareClass);

        $response = $middleware->process($request, $this);

        return $response;
    }
}
