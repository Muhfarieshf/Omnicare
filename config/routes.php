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

        // --- Search routes ---
        // Main search page
        $builder->connect('/search', ['controller' => 'Search', 'action' => 'index']);
        // Quick search API endpoint (for dropdown)
        $builder->connect('/search/quick', ['controller' => 'Search', 'action' => 'quick']);
        // Alternative search route with query parameter
        $builder->connect('/search/*', ['controller' => 'Search', 'action' => 'index']);

        // Default CakePHP routes
        $builder->fallbacks('DashedRoute');
    });

    // Optional: Add search shortcuts for different types
    $routes->scope('/search', function (RouteBuilder $builder) {
        $builder->connect('/patients', ['controller' => 'Search', 'action' => 'index', 'type' => 'patient']);
        $builder->connect('/doctors', ['controller' => 'Search', 'action' => 'index', 'type' => 'doctor']);
        $builder->connect('/appointments', ['controller' => 'Search', 'action' => 'index', 'type' => 'appointment']);
    });


    
};