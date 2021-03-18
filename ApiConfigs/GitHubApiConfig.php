<?php

namespace emteknetnz\ApiDataFetcher\Apis;

use emteknetnz\ApiDataFetcher\Misc\Consts;
use emteknetnz\ApiDataFetcher\Requesters\AbstractRequester;
use SilverStripe\Core\Environment;

class GitHubApiConfig implements ApiConfigInterface
{
    private const DOMAIN = 'https://api.github.com';

    public function getType(): string
    {
        return 'github';
    }

    public function getCredentials(): string
    {
        return implode(':', [Environment::getEnv('GITHUB_USER'), Environment::getEnv('GITHUB_TOKEN')]);
    }

    public function getHeaders(AbstractRequester $requester, string $method): array
    {
        return [
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'
        ];
    }

    public function getCurlOptions(): array
    {
        return [
            CURLOPT_USERPWD => $this->getCredentials()
        ];
    }

    public function deriveUrl(string $path): string
    {
        $domain = self::DOMAIN;
        $remotePath = str_replace($domain, '', $path);
        $remotePath = ltrim($remotePath, '/');
        // requesting details
        if (preg_match('#/[0-9]+$#', $remotePath) || preg_match('@/[0-9]+/files$@', $remotePath)) {
            return "{$domain}/{$remotePath}";
        }
        // requesting a list
        $op = strpos($remotePath, '?') ? '&' : '?';
        return"{$domain}/{$remotePath}{$op}per_page=100";
    }
}
