<?php
$PDO = new PDO('mysql:host=127.0.0.1;dbname=tuto','root', '');
//$bdd = new PDO('mysql:host=localhost;dbname=ciw_mysql','ciw_mysql', 'aigah4sh');
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>
