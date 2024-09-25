<?php

namespace Somecode\Framework\Http;

class Request
{
    public function __construct(
        private readonly array $getParams,
        public readonly array $postData,
        private readonly array $cookies,
        private readonly array $files,
        private readonly array $server,
    ) {}

    public static function CreateFromGlobals(): static
    {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function getPath(): string
    {
        return strtok($this->server['REQUEST_URI'], token: '?');
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }
}
