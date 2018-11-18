<?php

namespace Elhebert\Tracking\Tools;

class Matomo extends TrackingTool
{
    public function configure()
    {
    }

    public function config(): array
    {
        return config('tracking.matomo');
    }

    protected function configIsValid(): bool
    {
        return !empty($this->config()['id'])
            && !empty($this->config()['url']);
    }
}
