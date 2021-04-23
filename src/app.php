<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('home', new Routing\Route('/', [
    '_controller' => 'Eshop\Controller\AppController::index',
], [], [], '', [], ['GET']));

$routes->add('register', new Routing\Route('/register', [
    '_controller' => 'Eshop\Controller\UserController::register',
], [], [], '', [], ['GET', 'POST']));

$routes->add('login', new Routing\Route('/login', [
    '_controller' => 'Eshop\Controller\UserController::login',
], [], [], '', [], ['GET', 'POST']));

$routes->add('logout', new Routing\Route('/logout', [
    '_controller' => 'Eshop\Controller\UserController::logout',
], [], [], '', [], ['GET']));

$routes->add('update_profile', new Routing\Route('/update-profile', [
    '_controller' => 'Eshop\Controller\UserController::update',
], [], [], '', [], ['GET', 'POST']));

$routes->add('new_product', new Routing\Route('/new-product', [
    '_controller' => 'Eshop\Controller\ProductController::add',
], [], [], '', [], ['GET', 'POST']));

$routes->add('update_product', new Routing\Route('/update-product', [
    '_controller' => 'Eshop\Controller\ProductController::update',
], [], [], '', [], ['GET', 'POST']));

$routes->add('delete_product', new Routing\Route('/delete-product', [
    '_controller' => 'Eshop\Controller\ProductController::delete',
], [], [], '', [], ['GET', 'POST']));

return $routes;
