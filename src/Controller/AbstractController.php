<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Psr\Log\LoggerInterface;


abstract class AbstractController extends Controller
{
    public function __construct(ContainerBagInterface $containerbag, LoggerInterface $logger)
    {
        $this->cb = $containerbag;

        $this->lg = $logger;
    }
}
