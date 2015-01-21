<?php
session_start();
$_SESSION['user_id'] = 1;
// require_once __DIR__.'/../vendor/autoload.php';
require_once '/var/www/html/dropbox/vendor/autoload.php';

$dropboxKey     = 'typf9dfvt8iort4';
$dropboxSeckret = 'tb57lm4n0vvloy3';
$appName		= 'join people';

$appInfo = new Dropbox\AppInfo($dropboxKey,$dropboxSeckret);
$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION,'dropbox-auth-csrf-token');
$webAuth = new Dropbox\WebAuth($appInfo,$appName,'http://localhost/dropbox/index.php',$csrfTokenStore);

//db
// $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=dropbox','root','root');
//user detail
/*    $users = $db->prepare('SELECT * FROM users where id = :user_id');
    $users->execute(['user_id'=>$_SESSION['user_id']]);
    $res = $users->fetchObject();
    var_dump($res);
*/
if($_GET['code'])
{
    var_dump($_GET);
    list($accesToken) = ($webAuth->finish($_GET));
    var_dump($accesToken);
}
else{
    $authUrl = $webAuth->start();
    header('Location:'.$authUrl);
    exit;
}