<?php

namespace Elhebert\Tracking\Trackers;

use Elhebert\Tracking\Traits\HasTools;

abstract class Tracker
{
    use HasTools;

    abstract public function configure();
}
