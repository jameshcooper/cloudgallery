<?php

namespace App\Controller;

use App\ImageServer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Glide\Signatures\SignatureFactory;


class ImageController extends AbstractController
{
    /**
     * @param ImageServer $imageserver
     * @param Request     $request
     * @param string      $title
     * @param mixed       $id
     *
     * @return Response
     */
    public function imageResponse(Request $request, ImageServer $imageserver, string $title, $id)
    {
        $key = $this->cb->get('gallery.key');

        SignatureFactory::create($key)->validateRequest($request->getPathInfo(), $request->query->all());

        $imageserver->intializeFactory();

        return $imageserver->server->getImageResponse(join('/', [$title, $id]), ['p' => $request->query->get('p')]);
    }
}
