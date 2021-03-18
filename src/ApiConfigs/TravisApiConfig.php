<?php

namespace emteknetnz\DataFetcher\Apis;

use emteknetnz\DataFetcher\Misc\Consts;
use emteknetnz\DataFetcher\Requesters\AbstractRequester;
use emteknetnz\DataFetcher\Requesters\RestRequester;
use SilverStripe\Core\Environment;


/*
Travis API States:
created - waiting for free workers
started - running
passed - green
errored - red
failed - red
canceled - grey - yes it's a typo in travis api
unknown - not in API, added by this script
*/
class TravisApiConfig implements ApiConfigInterface
{
    private const DOMAIN = 'https://api.travis-ci.com';

    public function getType(): string
    {
        return 'travis';
    }

    public function getCredentials(): string
    {
        return Environment::getEnv('TRAVIS_TOKEN');
    }

    public function getHeaders(AbstractRequester $requester, string $method): array
    {
        if (get_class($requester) == RestRequester::class) {
            if ($method == Consts::METHOD_GET) {
                return [
                    'Travis-API-Version: 3',
                    'Accept: application/vnd.travis-ci.2.1+json',
                    'Authorization: token "' . $this->getCredentials() . '"'
                ];
            } elseif ($method == Consts::METHOD_POST) {
                return [
                    'Travis-API-Version: 3',
                    'Content-Type: application/json',
                    'Authorization: token "' . $this->getCredentials() . '"'
                ];
            }
        }
        return [];
    }

    public function getCurlOptions(): array
    {
        return [];
    }

    public function deriveUrl(string $path): string
    {
        $domain = self::DOMAIN;
        $remotePath = str_replace($domain, '', $path);
        $remotePath = ltrim($remotePath, '/');
        return "{$domain}/{$remotePath}";
    }
}
