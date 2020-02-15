<?php

namespace App\Filesystem;

use League\Flysystem\Filesystem;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractFilesystem extends Filesystem
{
    public $directory;
    public $directory_contents;

    public function setDirectory(string $name)
    {
        $this->directory = $name;
    }

    public function listDirectories()
    {
        $fetch_directory = $this->listContents($this->directory, true);

        if ($fetch_directory == []) {
            throw new \Exception('Directory not found');
        }

        $fetch_directory = new ArrayCollection($fetch_directory);

        $directory_files = $fetch_directory->filter(function ($k) {
            return 'dir' == $k['type'];
        });

        $contents = [];

        foreach ($directory_files as $files) {
            $contents[] = $files['basename'];
        }

        $this->directory_contents = $contents;
    }

    public function listDirectoryContents()
    {
        $fetch_directory = $this->listContents($this->directory, true);

        if ($fetch_directory == []) {
            throw new \Exception('Directory not found');
        }

        $fetch_directory = new ArrayCollection($fetch_directory);

        $directory_files = $fetch_directory->filter(function ($k) {
            return 'dir' != $k['type'];
        });

        $contents = [];

        foreach ($directory_files as $files) {
            $pic_types = ['jpg', 'jpeg', 'gif', 'png'];

            foreach ($pic_types as $p) {
                if ($files['extension'] == $p) {
                    $contents[$files['basename']] = $files;
                }
            }
        }

        $this->directory_contents = $contents;
    }

    public function renameDirContents(string $prefix)
    {
        $count = 0;

        foreach ($this->directory_contents as $item) {

            $count++;

            $name_ext = (string) $count .  '.' . $item["extension"];

            $this->rename($item["path"], $item["dirname"] . '/' . $prefix . $name_ext);
        }
    }
}
