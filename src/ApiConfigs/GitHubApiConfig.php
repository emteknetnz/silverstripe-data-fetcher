<?php

namespace emteknetnz\DataFetcher\Apis;

use emteknetnz\DataFetcher\Misc\Consts;
use emteknetnz\DataFetcher\Requesters\AbstractRequester;
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

    public function deriveUrl(string $path, string $paginationOffset = ''): string
    {
        $domain = self::DOMAIN;
        $remotePath = str_replace($domain, '', $path);
        $remotePath = ltrim($remotePath, '/');
        // requesting details
        if (!$this->supportsPagination($path)) {
            return "{$domain}/{$remotePath}";
        }
        // requesting a list
        $offset = $paginationOffset ? "&page={$paginationOffset}" : '';
        $op = strpos($remotePath, '?') ? '&' : '?';
        return "{$domain}/{$remotePath}{$op}per_page=100{$offset}";
    }

    public function supportsPagination(string $path): bool 
    {
        // requesting details
        if (preg_match('#/[0-9]+$#', $path) || preg_match('@/[0-9]+/files$@', $path)) {
            return false;
        }
        // returning a list
        return true;
    }

    public function getPaginationOffsetInitial(): int
    {
        // page=
        return 1;
    }

    public function getPaginationOffsetIncrement(): int
    {
        // page=(+1)
        return 1;
    }

    public function getPaginationOffsetMaximum(): int
    {
        // page=
        return 10;
    }
}
