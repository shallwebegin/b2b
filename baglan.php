<?php


try {

    $db = new PDO("mysql:host=localhost;dbname=sulusmot_b2b;charset=utf8;", "sulusmot_beko", "gilbeys2222");
    $db->query("SET CHARACTER SET utf8");
    $db->query("SET NAMES utf8");
} catch (PDOException $e) {
    print_r($e->getMessage());
    die();
}
