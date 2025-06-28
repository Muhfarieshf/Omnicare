<?php
// config/routes.php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass('DashedRoute');

    $routes->scope('/', function (RouteBuilder $builder) {
        // Default route to OmniCare homepage
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);
        
        // Dashboard route
        $builder->connect('/dashboard', ['controller' => 'Appointments', 'action' => 'dashboard']);
        
        // Authentication routes
       $builder->connect('/users/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/users/register', ['controller' => 'Users', 'action' => 'register']);
        $builder->connect('/users/logout', ['controller' => 'Users', 'action' => 'logout']);

        // Default CakePHP routes
        $builder->fallbacks('DashedRoute');
    });
};