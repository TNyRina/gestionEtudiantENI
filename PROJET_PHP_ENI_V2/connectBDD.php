<?php 
	$DB_DSN='mysql:host=localhost;dbname=gestion_de_soutenance';
    $DB_USER='root';
    $DB_PASS='nouveaumotdepasse';

    $PDO = new PDO(
                $DB_DSN,
                $DB_USER,
                $DB_PASS,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
 ?>