<?php

namespace App\Service;

use Exception;

class Client
{
    private $client;
    private $endpoint;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->endpoint = config('app.base_api_url');
    }

    public function get($url)
    {
        $response = $this->client->request('GET', $this->endpoint . $url, [
            'headers' => [
                'Accept' => 'application/json',                      
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function getWithAuth($url)
    {
        $response = $this->client->request('GET', $this->endpoint . $url, [
            'headers' => [
                'Accept' => 'application/json',
                'user-uuid' => '9993367b6505470fa2d1fad8c3990754',
                'authorization'=> 'Bearer ' .session()->get('bearer_token')              
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }    

    public function post($url, $data)
    {
        try {
            $response = $this->client->request('POST', $this->endpoint . $url, [
                'form_params' => $data,
                "headers" => [
                    'Accept' => 'application/json',
                    'authorization'=> 'Bearer ' .session()->get('bearer_token')             
                ]
            ]);
            // dd($response);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function post_like($url)
    {
        try {
            $response = $this->client->request('POST', $this->endpoint . $url, [
                
                "headers" => [
                    'Accept' => 'application/json',
                    'authorization'=> 'Bearer ' .session()->get('bearer_token')             
                ]
            ]);
            // dd($response);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }
    public function postWithAuth($url, $data)
    {
        try {
            $response = $this->client->request('POST', $this->endpoint . $url, [
                'form_params' => $data,
                "headers" => [
                    'Accept' => 'application/json',
                    'user-uuid' => '9993367b6505470fa2d1fad8c3990754',
                    'authorization'=> 'Bearer ' .session()->get('bearer_token')              
                ]
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function put($url, $data)
    {
        $response = $this->client->request('PUT', $this->endpoint . $url, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function delete($url)
    {
        $response = $this->client->request('DELETE', $this->endpoint . $url, [
            
            "headers" => [
                'Accept' => 'application/json',
                'user-uuid' => '9993367b6505470fa2d1fad8c3990754',
                'authorization'=> 'Bearer ' .session()->get('bearer_token')              
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }
}
