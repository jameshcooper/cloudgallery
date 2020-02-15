<?php

namespace App\Filesystem;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class CloudFilesystem extends AbstractFilesystem
{
    public $dir_name;
    public $dir_type;
    public $dir_contents;

    public function __construct(ContainerBagInterface $containerbag)
    {
        $s3 = $containerbag->get('cloud');

        $client = S3Client::factory([
            'credentials' => [
                'key' => $s3['key'],
                'secret' => $s3['secret'],
            ],
            'region' => $s3['region'],
            'version' => 'latest',
            'version'     => "latest",
            'bucket_endpoint' => false,
            'use_path_style_endpoint' => true,
            'endpoint'    => $s3['url'],
        ]);

        $bucket = $s3['bucket'];
        
        $adapter = new AwsS3Adapter($client, $bucket);

        parent::__construct($adapter);
    }
}
