<?php

namespace Weijiajia\DecryptVerificationCode\CloudCode\Data;

use Spatie\LaravelData\Data as BaseData;

class Data extends BaseData
{
    public function __construct(
        public int $code,
        public string $data,
        public float $time,
        public string $unique_code,
    ) {}
}
