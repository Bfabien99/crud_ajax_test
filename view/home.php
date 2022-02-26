<?php
    require 'sql/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body id="body">
    <div class="container">

        <div class="left">
            <h2>Formulaire d'inscription</h2>
            <form action="" method="post" id="form" autocomplete="off">

                <div class="group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Entrer le nom">
                </div>
                <div class="group">
                    <label for="prenoms">Prenoms</label>
                    <input type="text" name="prenoms" id="prenoms" placeholder="Entrer le prenom">
                </div>
                <div class="group">
                    <label for="numéro">Numéro</label>
                    <input type="tel" name="numéro" id="numero" placeholder="Entrer le numéro">
                </div>
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Entrer l'Email">
                </div>

                <input type="submit" id="save" value="Enregistrer" name="save">
                <div id="message"></div>

            </form>

        </div>

        <div class="right">

            <h2>Liste des inscrits</h2>

            <div class="box">
                <table id="result">

                <tr>
                    <td>Id</td>
                    <td>Nom & prénoms</td>
                    <td>Email</td>
                    <td>Action</td></tr>
            
            </table>
            </div>
            

        </div>

    </div>

</body>
<script src="jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        load_user();
        function load_user() 
        {
            $.ajax({
                type: "POST",
                url: 'sql/alluser.php',
                data: {
                    'load_user': true
                },
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    $('#result').html("<tr><td>Id</td><td>Nom & prénoms</td><td>Email</td><td>Action</td></tr>")
                    $.each(jsonData, function(key, value) {
                        $('#result').append('<tr><td>'+value.id+'</td><td>'+value.nom+' '+value.prenoms+'</td><td>'+value.email+'</td><td><button class="delete" id="'+value.id+'">Supprimer</button></td></tr>');
                    })
                }
            });
        };


        $(document).on('click','.delete',function(){
            var thisClick = $(this);
            var del_id = thisClick.attr('id');
            
            $.ajax({
                type: "POST",
                url: 'sql/deluser.php',
                data: {
                    'id': del_id,
                    'delete_user': true
                },
                success: function(response) {
                    load_user();
                    $("#message").html("<p style='color:red;'>Supprimé</p>");
                    setInterval(function(){
                        $("#message").html("");
                    },2000)
                    clearInterval()
                }
            });

        })


        $('#save').click(function(e)
        {
            e.preventDefault();
            
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var numero = $('#numero').val();
            var email = $('#email').val();

            if(nom != "" && prenoms != "" && numero != "" && email != ""){    
                var data = {
                    "nom" : nom.toUpperCase(),
                    "prenoms" : prenoms.toUpperCase(),
                    "numero" : numero.toUpperCase(),
                    "email" : email.toUpperCase(),
                }

                $.ajax({

                    type: "POST",

                    url: 'sql/insert.php',

                    data: data,

                    success: function()
                    {
                        load_user();
                        $("#nom").val("");
                        $("#prenoms").val("");
                        $("#numero").val("");
                        $("#email").val("");
                        $("#message").html("<p style='color:green;'>Enregistré</p>");
                        setInterval(function(){
                            $("#message").html("");
                        },2000)
                        clearInterval()
                    }

                });
            }else{
                alert("Please fill all the input");
            }

        });

    })
    
</script>
</html>