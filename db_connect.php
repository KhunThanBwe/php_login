<?php
    $serverName = '127.0.0.1';
    $userName = 'root';
    $userPassword = '';
    $dbName = 'php_login';

    $connect = mysqli_connect($serverName, $userName, $userPassword, $dbName);

    if(!$connect) {
        die('ERROR: '.mysqli_error($connect));
    }

?>