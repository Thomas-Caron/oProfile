<?php

$this->router->addRoute(
    'user_dashboard',
    'GET',
    'user/dashboard',
    [
        'controllerName' => 'oProfile\Plugin\Registration\Controller\UserDashboardController',
        'methodName'     => 'display'
    ]
);

$this->router->addRoute(
    'user_profile',
    'GET',
    'user/profile',
    [
        'controllerName' => 'oProfile\Plugin\Registration\Controller\UserProfileController',
        'methodName'     => 'display'
    ]
);

$this->router->addRoute(
    'user_profile_update',
    'POST',
    'user/profile/update',
    [
        'controllerName' => 'oProfile\Plugin\Registration\Controller\UserProfileController',
        'methodName'     => 'update'
    ]
);

$this->router->addRoute(
    'user_technology',
    'GET',
    'user/technology',
    [
        'controllerName' => 'oProfile\Plugin\Registration\Controller\UserTechnologyController',
        'methodName'     => 'display'
    ]
);


$this->router->addRoute(
    'user_technology_update',
    'POST',
    'user/technology/update',
    [
        'controllerName' => 'oProfile\Plugin\Registration\Controller\UserTechnologyController',
        'methodName'     => 'update'
    ]
);
