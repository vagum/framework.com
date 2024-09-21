<?php

namespace Somecode\Framework\Tests;

class AreaWeb
{
    public function __construct(
        private readonly Telegram $telegram,
        private readonly Youtube $youtube
    ) {}

    public function getTelegram(): Telegram
    {
        return $this->telegram;
    }

    public function getYoutube(): Youtube
    {
        return $this->youtube;
    }
}
