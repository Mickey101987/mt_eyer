<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;
phpinfo();
return function (App $app) {
    // Redirect to Swagger documentation
    $app->get("/", \App\Action\Home\HomeAction::class)->setName('home');

    // Swagger API documentation
    $app->get("/home", \App\Action\LandingPage\LandingPage::class)->setName('landingPage');

    $app->get('/logout', \App\Action\Logout\LogoutAction::class)
        ->add(new HttpBasicAuthentication([
            "users" => [
                "ignore" => "/logout",
                "root" => "t00r",
                "somebody" => "passw0rd"
            ]
        ]))
        ->setName('logout');

    // Password protected area
    $app->group(
        '/admin',
        function (RouteCollectorProxy $app) {
            $app->get('/home', \App\Action\AdminTemplate\DashboardHomeAction::class);
            $app->get('/communes', \App\Action\AdminTemplate\CommuneAction::class);
            $app->get('/agents', \App\Action\AdminTemplate\AgentAction::class);
            $app->get('/taximen', \App\Action\AdminTemplate\TaximanAction::class);
        }
    )->add(HttpBasicAuthentication::class);

    // Password protected area
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            //Users routes
            $app->get('/users', \App\Action\User\UserFindAction::class);
            $app->post('/user', \App\Action\User\UserCreateAction::class);
            $app->get('/user/{user_id}', \App\Action\User\UserReadAction::class);
            $app->put('/user/{user_id}', \App\Action\User\UserUpdateAction::class);
            $app->delete('/user/{user_id}', \App\Action\User\UserDeleteAction::class);

            //Taximen routes
            $app->get('/taximen', \App\Action\Taximan\TaximanFindAction::class);
            $app->get('/taximen/{agent_id}', \App\Action\Taximan\TaximanFindAction::class);
            $app->post('/taximan', \App\Action\Taximan\TaximanCreateAction::class);
            $app->get('/taximan/{taximan_id}', \App\Action\Taximan\TaximanReadAction::class);
            $app->put('/taximan/{taximan_id}', \App\Action\Taximan\TaximanUpdateAction::class);
            $app->delete('/taximan/{taximan_id}', \App\Action\Taximan\TaximanDeleteAction::class);

            //Communes routes
            $app->get('/communes', \App\Action\Commune\CommuneFindAction::class);
            $app->post('/commune', \App\Action\Commune\CommuneCreateAction::class);
            $app->get('/commune/{commune_id}', \App\Action\Commune\CommuneReadAction::class);
            $app->put('/commune/{commune_id}', \App\Action\Commune\CommuneUpdateAction::class);
            $app->delete('/commune/{commune_id}', \App\Action\Commune\CommuneDeleteAction::class);

            //Agents routes
            $app->get('/agents', \App\Action\Agent\AgentFindAction::class);
            $app->post('/agent', \App\Action\Agent\AgentCreateAction::class);
            $app->get('/agent/{agent_id}', \App\Action\Agent\AgentReadAction::class);
            $app->put('/agent/{agent_id}', \App\Action\Agent\AgentUpdateAction::class);
            $app->delete('/agent/{agent_id}', \App\Action\Agent\AgentDeleteAction::class);

            //Files routes
            $app->get('/files/{taximan_id}', \App\Action\File\FileFindAction::class);
            $app->post('/file', \App\Action\File\FileCreateAction::class);
            $app->get('/file/{file_id}', \App\Action\File\FileReadAction::class);
            $app->put('/file/{file_id}', \App\Action\File\FileUpdateAction::class);
            $app->delete('/file/{file_id}', \App\Action\File\FileDeleteAction::class);
        }
    )->add(HttpBasicAuthentication::class);
};
