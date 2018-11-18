<?php

namespace Elhebert\Tracking;

use Elhebert\Tracking\Trackers\Tracker;
use Elhebert\Tracking\Exceptions\InvalidTracker;

class TrackingFactory
{
    public static function create(string $className): Tracker
    {
        $tracker = app($className);

        if (!is_a($tracker, Tracker::class, true)) {
            throw InvalidTracker::create($tracker);
        }

        return $tracker;
    }
}
