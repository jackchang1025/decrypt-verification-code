<?php

namespace Weijiajia\DecryptVerificationCode;

interface CloudCodeResponseInterface
{
    public function getCode(): string|int;
    
}