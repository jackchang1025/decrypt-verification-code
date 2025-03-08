<?php

namespace Weijiajia\DecryptVerificationCode\CloudCode\Data;

use Spatie\LaravelData\Data as BaseData;
use Weijiajia\DecryptVerificationCode\CloudCodeResponseInterface;

class CloudCodeResponse extends BaseData implements CloudCodeResponseInterface
{
    // {"msg":"识别成功","code":10000,"data":{"code":0,"data":"wfmk","time":0.012115478515625,"unique_code":"c2dfaa1d5d06a87855abf069c2baa33f"}}
    public function __construct(
        public string $msg,
        public int $code,
        public Data $data,
    ) {
    }

    public function getCode(): string|int
    {
        return $this->data->data;
    }
    
}
