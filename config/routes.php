<?php
// config/routes.php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass('DashedRoute');

    $routes->scope('/', function (RouteBuilder $builder) {
        // Default route to login
        $builder->connect('/', ['controller' => 'Users', 'action' => 'login']);
        
        // Dashboard route
        $builder->connect('/dashboard', ['controller' => 'Appointments', 'action' => 'dashboard']);
        
        // Authentication routes
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/register', ['controller' => 'Users', 'action' => 'register']);
        $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

        // Default CakePHP routes
        $builder->fallbacks('DashedRoute');
    });
};