<?php

namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Router;

// Authentication plugin
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;

class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    public function bootstrap(): void
    {
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        $this->addPlugin('Authentication');
        $this->addPlugin('Authorization');
        $this->addPlugin('CsvView');

        // DebugKit is already loaded by default in CakePHP, so we don't need to add it again
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
                'secure' => false,  // false for local development
            ]))

            ->add(new AuthenticationMiddleware($this));

        return $middlewareQueue;
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $authenticationService = new AuthenticationService([
        'unauthenticatedRedirect' => Router::url('/users/login'),
        'queryParam' => 'redirect',
    ]);

    // Load identifiers - ONLY use username, not email
    $authenticationService->loadIdentifier('Authentication.Password', [
        'fields' => [
            'username' => 'username',  // Only username field
            'password' => 'password',
        ],
        'passwordHasher' => [
            'className' => 'Authentication.Default',  // Use CakePHP's hasher
        ],
    ]);

    // Load authenticators
    $authenticationService->loadAuthenticator('Authentication.Session');
    $authenticationService->loadAuthenticator('Authentication.Form', [
        'fields' => [
            'username' => 'username',  // Only username field
            'password' => 'password',
        ],
        'loginUrl' => Router::url('/users/login'),
    ]);

    return $authenticationService;
}

    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');
    }
}