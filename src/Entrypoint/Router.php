<?php

namespace IESLaCierva\Entrypoint;

use Symfony\Component\HttpFoundation\Request;

class Router
{
    const CONTROLLERS_PATH = 'IESLaCierva\Entrypoint\Controllers\\';

    public function execute(Request $request): Controller
    {
        $map = [
            '/home' => self::CONTROLLERS_PATH.'HomeController',
        ];

        $path = $request->getPathInfo();
        if (isset($map[$path])) {
            return new $map[$path];
        } else {
            throw new \Exception('Path not found');
        }
    }
}
