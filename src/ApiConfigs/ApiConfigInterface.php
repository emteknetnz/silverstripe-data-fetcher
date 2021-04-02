<?php

namespace emteknetnz\DataFetcher\Apis;

use emteknetnz\DataFetcher\Requesters\AbstractRequester;
use emteknetnz\DataFetcher\Interfaces\TypeInterface;

interface ApiConfigInterface extends TypeInterface
{
    public function getCredentials(): string;

    public function getHeaders(AbstractRequester $requester, string $method): array;

    public function getCurlOptions(): array;

    public function deriveUrl(string $path): string;

    public function supportsPagination(string $path): bool;

    public function getPaginationOffsetInitial(): int;

    public function getPaginationOffsetIncrement(): int;

    public function getPaginationOffsetMaximum(): int;
}
