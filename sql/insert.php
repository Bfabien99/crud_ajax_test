<?php
    require 'dbconnect.php';
    $db = $connect;

    function secure($data){
        $data = htmlspecialchars(strip_tags(trim($data)));
        return $data;
    }

    if (!empty($_POST['nom'])) {
        $nom = secure($_POST['nom']);
        $prenoms = secure($_POST['prenoms']);
        $numero = secure($_POST['numero']);
        $email = secure($_POST['email']);

        $query = $db->prepare('INSERT INTO users SET nom = :nom, prenoms = :prenoms, numero = :numero, email = :email');
        $result = $query->execute([
            "nom" => $nom,
            "prenoms" => $prenoms,
            "numero" => $numero,
            "email" => $email
        ]);
    
    }
        
        // $sql = $db->prepare("SELECT * FROM users");
        // $sql->execute();
        // $list = $sql->fetchAll(PDO::FETCH_ASSOC);
        // if(count($list) > 0){
        //     while($list){
        //         $data [] = array('id' => $list['id'], 'nom' => $list['nom'], 'prenom' =>$list['prenom'], 'numero' =>$list['numero'], 'email' =>$list['email']);
        //     }
        // }
        // echo json_encode($data);

    
?>