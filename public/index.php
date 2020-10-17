<?php

require('../vendor/autoload.php');

use Oauth\Auth;

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: http://client.gitgraph.com');
    header('Access-Control-Allow-Credentials: true');
    return http_response_code(200);
} else if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    return http_response_code(405);
}

(new Auth())->getGithubToken();
