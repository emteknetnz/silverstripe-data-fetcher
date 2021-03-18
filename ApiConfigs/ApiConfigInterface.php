<?php

namespace emteknetnz\ApiDataFetcher\Apis;

use emteknetnz\ApiDataFetcher\Requesters\AbstractRequester;
use emteknetnz\ApiDataFetcher\Interfaces\TypeInterface;

interface ApiConfigInterface extends TypeInterface
{
    public function getCredentials(): string;

    public function getHeaders(AbstractRequester $requester, string $method): array;

    public function getCurlOptions(): array;

    public function deriveUrl(string $path): string;
}
