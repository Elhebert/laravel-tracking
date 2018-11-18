<?php

namespace Elhebert\Tracking;

use Illuminate\Http\Request;

class AddTrackingCodeMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $response = $next($request);

        if (
            !config('tracking.enabled')
            || (config('support_dnt') && $request->header('DNT') === '1')
        ) {
            return $response;
        }

        $tracker = TrackingFactory::create(config('tracking.tracker'));
        $tracker->configure();
        $tracker->getTools()->each->addTrackingCodeTo($response);

        return $response;
    }
}
