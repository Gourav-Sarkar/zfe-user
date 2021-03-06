<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

$app->get('/', \ZfeUser\Action\HomePageAction::class, 'home');
$app->get('/api/ping', \ZfeUser\Action\PingAction::class, 'api.ping');
//$app->get('/user/register', App\Action\UserRegisterAction::class, 'user.register');
//$app->get('/user/login', App\Action\UserLoginAction::class, 'user.login');
//$app->get('/user/forgot-password', App\Action\UserRegisterAction::class, 'user.register');
//$app->get('/user/change-password', App\Action\UserLoginAction::class, 'user.login');
//$app->get('/user/change-email', App\Action\UserLoginAction::class, 'user.login');
