<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    
    if(isset($_GET['message'])){

        $message = htmlspecialchars($_GET['message']);

        switch ($message) {
            case 'enregistrement':
                
                $message = 'Enregistrement reussi !';

            break;

            case 'modification':
                
                $message = ' Modification réussi !';

            break;

            
            default:
                # code...
                break;
        }

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="refresh" content="10; url=index.php">
                <title>Succès</title>
                <style>
                    body{
                        background-color: #ddd5d8;
                        margin:0px;
                    }
                    #message{
                        background-color: white;
                        width:40%;
                        margin-top: 5%;
                        margin-left: 30%;
                        padding: 10px 15px;
                        border-radius:2px;
                        overflow: hidden;
                        padding:20px;
                    }
                    h1{
                        text-align:center;
                        font-family:arial black;
                        color: #d87d16;
                        font-size:20px;
                        margin-bottom: 30px;
                    }
                    .click{
                        text-decoration: none;
                        background-color: #ddd5d8;
                        padding: 15px;
                        color: #3f3f41;
                        transition-property: background-color;
                        transition-duration: 0.3s;
                        transition-delay: 0s;
                        display: block;
                        width: 40%;
                        text-align: center;
                        font-family: arial;
                    }
                    .click{
                        margin-left:26%;
                    }
                    .click:hover{
                        background-color: #d87d16;
                        color: white;
                    }
                </style>
            </head>
            <body>
                <div id="message">
                    <h1> <?php echo $message?> </h1>
                    <a href="recherche.php" class="click">  Terminer </a>
                </div>
            </body>
            </html>
            <?php
    }
}