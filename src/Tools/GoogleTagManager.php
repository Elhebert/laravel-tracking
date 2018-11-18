<?php

namespace Elhebert\Tracking\Tools;

use Elhebert\Croustillon\Cookies\GA;
use Elhebert\Croustillon\Cookies\GID;

class GoogleTagManager extends TrackingTool
{
    public function configure()
    {
        $this
            ->addCookie(GA::class)
            ->addCookie(GID::class);
    }

    public function config(): array
    {
        return config('tracking.gtm');
    }

    protected function configIsValid(): bool
    {
        return !empty($this->config()['id']);
    }
}
