<?php

namespace IESLaCierva\Entrypoint\Controllers\Ui;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function execute(Request $request): Response
    {
        return $this->render('home.twig',[]);
    }

}
