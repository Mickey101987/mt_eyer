<?php

/**
 * Environment specific application configuration.
 *
 * You should store all secret information (username, password, tokens, private keys) here.
 *
 * Make sure the env.php file is added to your .gitignore
 * so it is not checked-in the code
 *
 * Place the env.php _outside_ the project root directory, to protect against
 * overwriting at deployment.
 *
 * This usage ensures that no sensitive passwords or API keys will
 * ever be in the version control history so there is less risk of
 * a security breach, and production values will never have to be
 * shared with all project collaborators.
 */

use Tuupola\Middleware\HttpBasicAuthentication\PdoAuthenticator;

require __DIR__ . '/local.development.php';

// Database
$settings['db']['username'] = 'root';
$settings['db']['password'] = '';

$settings['api_auth'] = [
    "path" => ["/admin", "/agents"],
    "secure" => true,
    "relaxed" => ["localhost"]
    "authenticator" => new PdoAuthenticator([
        "pdo" => $settings['pdo'],
        "table" => "users",
        "user" => "username",
        "hash" => "password"
    ]),
    "error" => function ($response, $arguments) {
        $data = [];
        $data["status"] = "error";
        $data["message"] = $arguments["message"];

        $body = $response->getBody();
        $body->write(json_encode($data, JSON_UNESCAPED_SLASHES));

        return $response->withBody($body);
    }
];
