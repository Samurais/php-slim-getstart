<?php
require $_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php';

// Create and configure Slim app
$config = ['settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
]];

$container = new \Slim\Container($config);

// add logger
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log',  \Monolog\Logger::INFO);
    $logger->pushHandler($file_handler);
    return $logger;
};

$app = new \Slim\App($container);

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
    $this->logger->info('Something interesting happened');
    return $response->write("Hello " . $args['name']);
});

// Run app
$app->run();
