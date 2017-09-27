<?php 


require_once 'app/init.php';

$auth->signout();
header('location: index.php');