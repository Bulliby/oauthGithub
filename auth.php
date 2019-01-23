<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class Github
{
    private $code;
    private $client_secret;
    private $client_id;
    private $redirect_uri;
    private $client;

    public function __construct($client_id, $client_secret, $redirect_uri)
    {
        if (!isset($_GET['code']))
            throw new \Exception('The code must be provided by query string $_GET["code"]');

        $this->code = $_GET['code'];
        $this->client_id = $client_id;
        $this->redirect_uri = $redirect_uri; 
        $this->client_secret = $client_secret;

        if ($this->client_secret == false)
            throw new \Exception("The var env CLIENT_SECRET is not set");

        $this->client = new GuzzleHttp\Client();
    }

    public function getGithubToken() 
    {
        $token = $this->client->request('POST', 'https://github.com/login/oauth/access_token', [
            'form_params' => [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'code' => $this->code
            ],
            'headers' => [
                'Accept'     => 'application/json',
            ]
        ]);

        var_dump(json_decode($token->getBody()));
    }
}
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$git = new Github('3c47a9a8faf9b82f5634', getenv('CLIENT_SECRET'), 'http://oauth/auth.php');
$git->getGithubToken();