<?php

namespace App;

final class Gallery
{
    public $gallery = [];

    public $album = [];

    public function __construct(ImageServer $imageserver, $key)
    {
        $this->imageserver = $imageserver;

        $this->key = $key;
    }

    public function getGallery()
    {
        return $this->gallery;
    }

    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    public function getAlbum()
    {
        return $this->album;
    }

    public function setAlbum(array $album)
    {
        $this->album = $album;
    }

    public function getAllAlbums()
    {
        $gallery = $this->imageserver->buildGallery();

        $this->setGallery($gallery);
    }

    public function buildAlbum($title, $preset)
    {
        $album = $this->imageserver->buildAlbum($this->key, $title, $preset);

        $this->setAlbum($album);
    }

    public function rename(string $title, string $prefix)
    {
        $this->imageserver->renameAlbum($title, $prefix);
    }
}
