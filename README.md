
# Decrypt Verification Code

A PHP package for decoding CAPTCHA verification codes using the jfbym.com cloud service API.

## Description

This package provides a simple interface for decrypting various types of verification code images by leveraging the jfbym.com API. It uses the Saloon HTTP client library for making API requests and handling responses.

## Installation

You can install the package via composer:

```bash
composer require weijiajia/decrypt-verification-code
```

## Requirements

- PHP 8.0 or higher
- [Saloon](https://github.com/Sammyjo20/Saloon) HTTP client
- A valid API token from jfbym.com

## Usage

### Basic Usage

```php
use Weijiajia\DecryptVerificationCode\CloudCode\CloudCodeConnector;

// Create a new connector instance
$connector = new CloudCodeConnector();

try {
    // Decode a verification code
    $response = $connector->decryptCloudCode(
        token: 'your-api-token',
        type: 'captcha-type-code', // Specific type code for the CAPTCHA format
        image: 'base64-encoded-image-data' // Base64 encoded image data
    );
    
    // Get the decoded verification code
    $code = $response->getCode();
    echo "Decoded CAPTCHA: " . $code;
    
} catch (DecryptCloudCodeException $e) {
    // Handle API-specific errors
    echo "API Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")";
} catch (\Exception $e) {
    // Handle other exceptions
    echo "Error: " . $e->getMessage();
}
```

### Response Structure

The API response is mapped to a `CloudCodeResponse` object with the following structure:

```php
CloudCodeResponse {
    public string $msg,
    public int $code,
    public Data $data {
        public int $code,
        public string $data, // The decoded verification code
        public float $time,
        public string $unique_code
    }
}
```

### With Logging

The connector supports logging functionality via the `HasLogger` trait:

```php
use Psr\Log\LoggerInterface;
use Weijiajia\DecryptVerificationCode\CloudCode\CloudCodeConnector;

// Create a PSR-3 compatible logger
$logger = /* your PSR-3 logger */;

// Create a connector with logging
$connector = new CloudCodeConnector();
$connector->setLogger($logger);

// Now API requests and responses will be logged
$response = $connector->decryptCloudCode(
    token: 'your-api-token',
    type: 'captcha-type-code',
    image: 'base64-encoded-image-data'
);
```

## Error Handling

The package throws a `DecryptCloudCodeException` when the API returns an error. The exception includes the error message and code from the API response.

```php
try {
    $response = $connector->decryptCloudCode(/* ... */);
} catch (DecryptCloudCodeException $e) {
    // API returned an error
    echo "API Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")";
} catch (JsonException $e) {
    // JSON parsing error
    echo "JSON Error: " . $e->getMessage();
} catch (RequestException $e) {
    // Request failed
    echo "Request Error: " . $e->getMessage();
} catch (FatalRequestException $e) {
    // Fatal request error
    echo "Fatal Request Error: " . $e->getMessage();
}
```

## API Reference

### CloudCodeConnector

#### `decryptCloudCode(string $token, string $type, string $image): CloudCodeResponseInterface`

Sends a request to the jfbym.com API to decode a verification code image.

Parameters:
- `$token` - Your API authentication token
- `$type` - The type code that specifies the CAPTCHA format
- `$image` - Base64 encoded image data

Returns:
- A `CloudCodeResponseInterface` object containing the decoded verification code

## License

This package is open-sourced software licensed under the MIT license.

## Credits

- [Author Name]
- [All Contributors]
