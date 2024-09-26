<?php

use Doctrine\DBAL\Connection;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Somecode\Framework\Console\Application;
use Somecode\Framework\Console\Commands\MigrateCommand;
use Somecode\Framework\Console\Kernel as ConsoleKernel;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Dbal\ConnectionFactory;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Middleware\RequestHandler;
use Somecode\Framework\Http\Middleware\RequestHandlerInterface;
use Somecode\Framework\Http\Middleware\RouterDispatch;
use Somecode\Framework\Routing\Router;
use Somecode\Framework\Routing\RouterInterface;
use Somecode\Framework\Session\Session;
use Somecode\Framework\Session\SessionInterface;
use Somecode\Framework\Template\TwigFactory;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv;
$dotenv->load(BASE_PATH.'/.env');

// Application parameters

$routes = include BASE_PATH.'/routes/web.php';
$appEnv = $_ENV['APP_ENV'] ?? 'local';
$viewsPath = BASE_PATH.'/views';
$databaseUrl = 'pdo-mysql://lemp:lemp@localhost:3306/lemp?charset=utf8mb4';

// Application services

$container = new Container;

$container->delegate(new ReflectionContainer(true));

$container->add('framework-commands-namespace', new stringArgument('Somecode\\Framework\\Console\\Commands\\'));

$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes', [new ArrayArgument($routes)]);

$container->add(RequestHandlerInterface::class, RequestHandler::class)
    ->addArgument($container);

$container->add(Kernel::class)
    ->addArguments([
        RouterInterface::class,
        $container,
        RequestHandlerInterface::class,
    ]);

$container->addShared(SessionInterface::class, Session::class);

$container->add('twig-factory', TwigFactory::class)
    ->addArguments([new StringArgument($viewsPath), SessionInterface::class]);

$container->addShared('twig', function () use ($container) {
    return $container->get('twig-factory')->create();
});

$container->inflector(AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(ConnectionFactory::class)
    ->addArgument(new StringArgument($databaseUrl));

$container->addShared(Connection::class, function () use ($container): Connection {
    return $container->get(ConnectionFactory::class)->create();
});

$container->add(Application::class)
    ->addArgument($container);

$container->add(ConsoleKernel::class)
    ->addArgument($container)
    ->addArgument(Application::class);

$container->add('console:migrate', MigrateCommand::class)
    ->addArgument(Connection::class)
    ->addArgument(new StringArgument(BASE_PATH.'/database/migrations'));

$container->add(RouterDispatch::class)
    ->addArguments([
        RouterInterface::class,
        $container,
    ]);

return $container;
