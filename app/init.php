<?php 

session_start();

$app = __DIR__;

require_once "{$app}/classes/ErrorHandler.php";
require_once "{$app}/classes/Validator.php";
require_once "{$app}/classes/Hash.php";
require_once "{$app}/classes/Database.php";
require_once "{$app}/classes/Auth.php";

$database = new Database;
$errorHandler = new ErrorHandler;
$hash = new Hash;
// $errorHandler->addError('Error 1', 'username');
// $errorHandler->addError('Error 2', 'username');
// $errorHandler->addError('Error 3', 'password');

// echo '<pre>', print_r($errorHandler->first('password')), '</pre>';

// $database->table('users')->insert([
// 'email' => 'haqim@mail.com',
// 'username' => 'haqim007',
// 'password' => 'password'
// ]);

// var_dump($database->table('users')->where('username', '=', 'haqim007')->count());


// $exist = $database->table('users')->exists(['username' => 'haqim007']);
// var_dump($exist);

// $user = $database->table('users')->where('username', '=', 'haqim007')->first();

// var_dump($user->username);

// var_dump($hash->verify('password', '$2y$10$LRtFA3bCZJsG98yaoR5UvuGVlFOjQ7l7LEx9T5f1HYLVgPkw2KlNC'));


$auth = new Auth($database, $hash);
