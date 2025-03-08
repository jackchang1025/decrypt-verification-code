<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Weijiajia\DecryptVerificationCode\CloudCode;


use JsonException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Weijiajia\DecryptVerificationCode\Exception\DecryptCloudCodeException;
use Weijiajia\SaloonphpLogsPlugin\HasLogger;
use Weijiajia\DecryptVerificationCode\CloudCodeResponseInterface;

class CloudCodeConnector extends Connector
{
    use HasLogger;
    use AlwaysThrowOnErrors;

    public function resolveBaseUrl(): string
    {
        return 'http://api.jfbym.com';
    }

    /**
     * @param string $token
     * @param string $type
     * @param string $image
     * @return CloudCodeResponseInterface
     * @throws DecryptCloudCodeException
     * @throws JsonException
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function decryptCloudCode(string $token, string $type, string $image): CloudCodeResponseInterface
    {
        $response = $this->send(new CloudCode(
            token: $token,
            type: $type,
            image: $image,
        ));

        if ($response->json('code') !== 10000) {
            throw new DecryptCloudCodeException(message: $response->json('msg'), code: $response->json('code'));
        }

        return $response->dto();
    }
}
