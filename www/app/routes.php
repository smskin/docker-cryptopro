<?php
declare(strict_types=1);

use App\Application\Actions\CryptoPro\ListCertificatesAction;
use App\Application\Actions\CryptoPro\SignAction;
use App\Application\Actions\CryptoPro\VerifySignAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/crypto-pro', function (Group $group) {
        $group->get('/certificates', ListCertificatesAction::class);
        $group->post('/sign', SignAction::class);
        $group->post('/verify-sign', VerifySignAction::class);
    });
};
