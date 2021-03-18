<?php

namespace emteknetnz\RhinoApi\Apis;

use emteknetnz\RhinoApi\Requesters\AbstractRequester;
use emteknetnz\RhinoApi\Interfaces\TypeInterface;

interface ApiConfigInterface extends TypeInterface
{
    public function getCredentials(): string;

    public function getHeaders(AbstractRequester $requester, string $method): array;

    public function getCurlOptions(): array;

    public function deriveUrl(string $path): string;
}
