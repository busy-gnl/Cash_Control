<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

// ...
class RedirectionService
{

    public function getPreviousRoute(Request $request, Session $session): string
    {
        $previousRoute = $session->get('_previous_route', '');
        $currentRoute = $request->get('_route');

        // $session->set('_previous_route', $currentRoute);

        return $previousRoute;
    }
}
