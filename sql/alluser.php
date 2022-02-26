<?php


    $servername = "localhost";
    $username ="root";
    $password ="";
    $dbname = "ajaxcrud";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("Connection error : ".mysqli_connect_error());
    }
   
  
    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $data [] = array('id' => $row['id'], 'nom' => $row['nom'], 'prenoms' =>$row['prenoms'], 'numero' =>$row['numero'], 'email' =>$row['email']);
        }
    }
    else{
        $data = [];
    }

    echo json_encode($data);
    
