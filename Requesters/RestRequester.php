<?php

namespace emteknetnz\RhinoApi\Requesters;

use emteknetnz\RhinoApi\Misc\Consts;
use emteknetnz\RhinoApi\Misc\Logger;

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
        $ch = curl_init();
        $url = $apiConfig->deriveUrl($path);
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
        return json_encode($json, JSON_PRETTY_PRINT);
    }
}
