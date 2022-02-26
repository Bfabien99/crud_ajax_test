<?php
    require 'dbconnect.php';
    $db = $connect;

        $query = $db->prepare("DELETE FROM users WHERE id = :id");
        $query->execute([
            'id' => $_POST['id']
        ]);
    