<?php

namespace Somecode\Framework\Event;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    private array $listeners = [];

    public function dispatch(object $event)
    {
        foreach ($this->getListenersForEvent($event) as $listener) {
            $listener($event);
        }
    }

    public function getListenersForEvent(object $event): iterable
    {
        return [];
    }
}
