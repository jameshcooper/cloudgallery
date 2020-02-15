<?php

namespace App\Controller;


class ClientController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke()
    {
        return $this->render('index.twig', ['app' => $this->cb->get('app')]);
    }
}
