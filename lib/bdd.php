<?php

    try {
        $dsn = "mysql:host=localhost;dbname=association_tf;charset=utf8mb4";
        $db_user = "yoann";
        $db_pass = "Simplon2023!";
        $pdo = new PDO($dsn, $db_user, $db_pass);
        echo "connexion réussit<br>";
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
