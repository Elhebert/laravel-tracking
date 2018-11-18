<?php

namespace Elhebert\Tracking\Exceptions;

class InvalidTracker extends \Exception
{
    public static function create($class): self
    {
        $className = get_class($class);

        return new self("The Tracker class `{$className}` is not valid.");
    }
}
