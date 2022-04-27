<?php

namespace App\Services;

use Endroid\QrCode\Builder\BuilderInterface;

class Qrcodeservice
{


    public function __construct(BuilderInterface $customQrCodeBuilder)
    {
        $result = $customQrCodeBuilder
            ->size(400)
            ->margin(20)
            ->build();
    }
}