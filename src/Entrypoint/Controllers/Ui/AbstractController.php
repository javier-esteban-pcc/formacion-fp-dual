<?php

namespace IESLaCierva\Entrypoint\Controllers\Ui;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected \Twig\Environment $twig;
    protected Response $response;

    public function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../../../Infrastructure/Views/Templates');
        $this->twig = new \Twig\Environment($loader, ['debug' => true]);
        $this->response = new Response();
    }

    protected function render($template, array $context): Response
    {
        $this->response->setContent($this->twig->render($template));
        return $this->response;
    }

    public abstract function execute(Request $request): Response;
}