<?php


namespace IESLaCierva\Entrypoint;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface Controller
{
    public function execute(Request $request): Response;
}