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

    public function addListener(string $event, callable $listener): static
    {
        $this->listeners[$event][] = $listener;

        return $this;
    }

    public function getListenersForEvent(object $event): iterable
    {
        $eventClass = get_class($event);

        if (array_key_exists($eventClass, $this->listeners)) {
            return $this->listeners[$eventClass];
        }

        return [];
    }
}
