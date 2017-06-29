<?php

//Routage
require '../Router/Kernel.php';
Router\Kernel::run();

use Router\Router\Router,
	Router\Router\Request as Req,
	Router\Router\Response as Res;

$app = new Router(['CASE_SENSITIVE' => true]);

//Gestion erreur 404
$app->setParam('404', function(Req $req, Res $res) {

	$res->setStatus(404);

	echo 'erreur 404 '.$req->getPath().'.';

});

//Accueil
$app->get('/index.php', function(Req $req, Res $res) {
	$res->redirect('/');
}); 
$app->get('/index.html', function(Req $req, Res $res) {
	$res->redirect('/');
});

$app->get('/', function(Req $req, Res $res) {

	require_once('../view/readmail.php');

});

//Lancement routage
$app->run();

/* plan *

GET 	/
GET 	/connexion/
GET 	/inscription/
POST 	/inscription/
GET 	/(pseudo)[a-zA-Z0-9_-]{3,15}
GET 	/infos/
GET 	/classement/

http://www.colorcombos.com/color-scheme-22.html

*/