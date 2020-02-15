<?php

namespace App\Filesystem;

use League\Flysystem\Adapter\Local;

class LocalFilesystem extends AbstractFilesystem
{
    public function __construct($appStorage)
    {
        parent::__construct(new Local($appStorage.'img/'));
    }
}
