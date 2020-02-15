<?php

namespace App;

use App\Filesystem\CloudFilesystem;
use App\Filesystem\LocalFilesystem;
use League\Glide\ServerFactory;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\Urls\UrlBuilderFactory;

class ImageServer
{
    public $server;

    const PRESETS = [
        'small' => [
            'w' => 800,
        ],
        'medium' => [
            'w' => 1024,
        ],
        'large' => [
            'w' => 2560,
        ],
    ];

    public function __construct(CloudFilesystem $cloud, LocalFilesystem $local)
    {
        $this->cloud = $cloud;

        $this->local = $local;
    }

    public function intializeFactory()
    {
        $this->server = ServerFactory::create([
            'source' => $this->cloud,
            'cache' => $this->local,
            'driver' => 'imagick',
            'presets' => $this::PRESETS,
            'max_image_size' => 2560 * 1400,
            'response' => new SymfonyResponseFactory(),
        ]);
    }

    public function buildGallery()
    {
        $gallery = [];

        $this->cloud->setDirectory('');

        $this->cloud->listDirectories();

        $gallery['gallery'] = $this->cloud->directory_contents;
        
        return $gallery;
    }

    public function buildAlbum($key, $title, $preset)
    {
        $album = [];

        $this->intializeBuilder($key);

        $this->cloud->setDirectory($title);

        $this->cloud->listDirectoryContents();

        if (!in_array($preset, array_keys(self::PRESETS))) {

            $preset = false;
        }

        $album['album'] = $this->createAlbum($this->cloud->directory, $this->cloud->directory_contents, $preset);

        return $album;
    }

    private function intializeBuilder($key)
    {
        $this->builder = UrlBuilderFactory::create('/img/', $key);
    }


    private function buildURL($dirname, $basename, $preset)
    {
        return $this->builder->getUrl(join('/', [$dirname, $basename]), ['p' => $preset]);
    }

    private function createAlbum($dirname, $images, $preset)
    {
        $create_album = [];

        if (!$preset) {

            foreach ($images as $image) {
                $album_all_sizes = [
                    'name' => $image['basename'],
                    'path' => [],
                ];

                foreach (array_keys(self::PRESETS) as $p) {
                    $path = $this->buildURL($dirname, $image['basename'], $p);

                    $album_all_sizes['path'][$p] = $path;
                }

                $create_album[] = $album_all_sizes;
            }
        } else {

            foreach ($images as $image) {
                $path = $this->buildURL($dirname, $image['basename'], $preset);

                $create_album[] = [
                    'name' => $image['basename'],
                    'path' => [$preset => $path],
                ];
            }
        }

        return $create_album;
    }

    public function renameAlbum(string $title, string $prefix)
    {
        $this->cloud->setDirectory($title);

        $this->cloud->listDirectoryContents();

        $this->cloud->renameDirContents($prefix);
    }
}
