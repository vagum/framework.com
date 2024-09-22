<?php

namespace Somecode\Framework\Console;

class Kernel
{
    public function handle(): int
    {
        dd('Hello, console!');

        return 0;
    }
}
