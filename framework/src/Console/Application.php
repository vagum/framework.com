<?php

namespace Somecode\Framework\Console;

use Psr\Container\ContainerInterface;

class Application
{
    public function __construct(
        private ContainerInterface $container
    ) {}

    public function run(): int
    {

        // 1. Получаем имя команды

        $argv = $_SERVER['argv'];
        $commandName = $argv[1] ?? null;

        // 2. Возвращаем исключение, если имя команды не указано
        if (! $commandName) {
            throw new ConsoleException('Invalid console command');
        }
        // 3. Используем имя команды для получения объекта класса команды из контейнера

        /** @var CommandInterface $command */
        $command = $this->container->get("console:$commandName");

        // 4. Получаем опции и аргументы

        // 5. Выполнить команду, возвращая код статуса
        $status = $command->execute();

        return $status;
    }
}
