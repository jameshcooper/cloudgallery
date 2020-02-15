<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Simple\PhpFilesCache;
use App\Gallery;


class GalleryController extends AbstractController
{
    const TYPE = 'gallery';

    public function index(Request $request, Gallery $gallery)
    {
        $gallery->getAllAlbums();

        return $this->json($gallery->getGallery());
    }

    /**
     * @param URLBuilder $URLBuilder
     * @param string     $title
     * @param string     $size
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function show(Request $request, Gallery $gallery, string $title)
    {
        $lifetime = 1;

        $storage = $this->cb->get('kernel.project_dir') . '/storage/api';

        $album_options = $request->query->all();

        $size = null;

        if ($album_options != []) {

            $lifetime = $album_options['lifetime'] ?? 1;

            $size = $album_options['size'] ?? null;
        }

        $cache_title = self::TYPE . $title . $size;

        $cache = new PhpFilesCache(self::TYPE, $lifetime, $storage);

        if (!$cache->has($cache_title)) {

            $gallery->buildAlbum($title, $size);

            $cache->set($cache_title, $gallery->getAlbum());
        }

        $this->lg->info($title);

        return $this->json($cache->get($cache_title));
    }
}
