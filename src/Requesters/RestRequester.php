<?php

namespace emteknetnz\DataFetcher\Requesters;

use emteknetnz\DataFetcher\Misc\Consts;
use emteknetnz\DataFetcher\Misc\Logger;

class RestRequester extends AbstractRequester
{
    public function getType(): string
    {
        return 'rest';
    }

    protected function fetchDataFromApi(string $path, string $postBody = ''): string
    {
        $method = $this->getMethod($postBody);
        $apiConfig = $this->apiConfig;
        $supportsPagination = $apiConfig->supportsPagination($path);
        $initial = $apiConfig->getPaginationOffsetInitial();
        $increment = $apiConfig->getPaginationOffsetIncrement();
        $maximum = $supportsPagination ? $apiConfig->getPaginationOffsetMaximum() : $initial;
        $results = [];
        for ($offset = $initial; $offset <= $maximum; $offset = $offset + $increment) {
            $ch = curl_init();
            $url = $apiConfig->deriveUrl($path, $offset);
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($method == Consts::METHOD_POST) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $apiConfig->getHeaders($this, $method));
            foreach ($apiConfig->getCurlOptions() as $curlOpt => $value) {
                curl_setopt($ch, $curlOpt, $value);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $this->waitUntilCanFetch();
            $s = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($s);
            if (!is_array($json) && !is_object($json)) {
                Logger::singleton()->log('Error fetching data');
                return '';
            }
            if (empty($json) || !$json) {
                break;
            }
            $results[] = $json;
        }
        if (!$supportsPagination) {
            return json_encode($results[0], JSON_PRETTY_PRINT);
        }
        $arr = [];
        foreach ($results as $result) {
            // Example of non array is github {'message' => 'Not Found'}
            // such as when requesting from paginatable url of a non-existant branch
            if (!is_array($result)) {
                continue;
            }
            $arr = array_merge($arr, $result);
        }
        return json_encode($arr, JSON_PRETTY_PRINT);
    }
}
