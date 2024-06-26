<?php

declare(strict_types=1);

namespace App\Traits;

use GuzzleHttp\Client;

trait RequestService
{
    /**
     * @param       $method
     * @param       $requestUrl
     * @param array $formParams
     * @param array $headers
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $requestUrl, $formParams = [], $headers = []): string
    {

        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $request = app('request');
        if (!empty($request->bearerToken())) {
            $headers['Bearer'] = $request->bearerToken();
        }

        if ($method === 'GET') {
            $response = $client->request($method, $requestUrl,
                [
                    'query' => $formParams,
                    'headers' => $headers
                ]
            );
        } else {
            $response = $client->request($method, $requestUrl,
                [
                    'form_params' => $formParams,
                    'headers' => $headers
                ]
            );
        }

        return $response->getBody()->getContents();
    }
}
