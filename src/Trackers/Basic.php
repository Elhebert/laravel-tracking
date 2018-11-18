<?php

namespace Elhebert\Tracking\Trackers;

use Elhebert\Tracking\Tools\Matomo;
use Elhebert\Tracking\Tools\GoogleTagManager;

class Basic extends Tracker
{
    public function configure()
    {
        $this
            ->addTool(Matomo::class)
            ->addTool(GoogleTagManager::class);
    }
}
