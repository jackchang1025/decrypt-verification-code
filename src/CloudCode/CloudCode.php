<?php

namespace Weijiajia\DecryptVerificationCode\CloudCode;

use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Enums\Method;
use Weijiajia\DecryptVerificationCode\CloudCode\Data\CloudCodeResponse;
use Saloon\Http\Response;

class CloudCode extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public string $token,
        public string $type,
        public string $image,
    ) {
    }

    public function defaultBody(): array
    {
        return [
            'token' => $this->token,
            'type' => $this->type,
            'image' => $this->image,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/api/YmServer/customApi';
    }

    public function createDtoFromResponse(Response $response): CloudCodeResponse
    {
        return CloudCodeResponse::from($response->json());
    }
    
}