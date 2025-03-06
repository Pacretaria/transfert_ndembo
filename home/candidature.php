<?php
include('db.php');

    $error_sub_form = null;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enregistrement des clients</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="logo/logo.png" type="image/png">
        <style>
            body{
                background-color: #ddd5d8;
            }
            form{
                background-color: white;
                width:60%;
                margin-left: 20%;
                padding: 10px 15px;
                border-radius:2px;
                overflow: hidden;
                padding-top:20px;
            }
            form h1{
                text-align:center;
                font-family:arial black;
                color: #d87d16;
                font-size:20px;
                margin-bottom: 30px;
            }
            .portion{
                width:90%;
                margin-left:5%;
            }
            input{
                height:40px;
                width:95%;
                margin: 2.5% 1.5%;
                border:1px solid #caccce;
                border-radius:3px;
            }
            select{
                height:45px;
                width:97%;
                margin: 2.5% 1.5%;
                border:1px solid #caccce;
                border-radius:3px;
            }
            label{
                margin-left:5px;
                font-family: arial;
                font-size: 14px;
                font-weight: bold;
                opacity:0.8;
            }
            #bouton_suivant{
                display: block;
                height:50px;
                width:95%;
                margin: 6% 1.5% 0% 1.5%;
                background-color: #720817;
                border-color: #720817;
                border-radius:2px;
                border:none;
                border:3px solid #720817;
                color:white;
                font-size:19px;
            }
            #bouton_suivant:hover{
                background-color: transparent;
                color: #720817;
            }
            #redirection{
                width:90%;
                height:30px;
                margin-bottom:25px;
                margin-left: 5%;
                background-color:#d87d16;
                color:white;
                border:none;
                border:3px solid #d87d16;
                border-radius:2px;
                font-size:17px;
                display: block;
                text-align: center;
                padding-top: 10px;
                text-decoration: none;
            }
            #redirection:hover{
                background-color: transparent;
                color: #d87d16;
            }
            .error{
                color: red;
                text-align: center;
            }

            @media screen and (max-width: 850px){
                #form_enregistrement{
                    width: 90%;
                    margin-left:3.5%;
                }
            }
            @media screen and (max-width: 500px){
                #form_enregistrement{
                    width: 80%;
                    margin-left:7%;
                }
            }
            @media screen and (max-width: 350px){
                #form_enregistrement{
                    width: 90%;
                    margin-left:1%;
                }
            }
        </style>
    </head>
    <body>
        <form action="pre_enregistrement.php" method="GET" id="form_enregistrement">

            <h1> VOS INFORMATIONS (Etape 1) </h1>

            <div id="conteneur">
                <div class="portion">
                    <div>
                        <label for="nom"> Nom </label>
                        <input type="text" required name="nom" id="nom">
                    </div>

                    <div>
                        <label for="prenom">Postnom</label>
                        <input type="text" required name="postnom" id="postnom">
                    </div>

                    <div>
                        <label for="prenom">Prénom</label>
                        <input type="text" required required name="prenom" id="prenom">
                    </div>

                    <div>
                        <label for="age"> Date de Naissance</label>
                        <input type="date" required name="age" id="age">
                    </div>

                    <div>
                        <label for="taille"> Taille</label>
                        <input type="number" required required step="0.01" name="taille" id="taille">
                    </div>

                    <div>
                        <label for="position"> Position </label>
                        <select name="position" required id="position">
                        <option value="Gardien de But">Gardien de But</option>
                            <option value="Défenseur Central">Défenseur Central (Libéro)</option>
                            <option value="Latéral Droit">Latéral Droit</option>
                            <option value="Latéral Gauche">Latéral Gauche</option>
                            <option value="Milieu Défensif">Milieu Défensif</option>
                            <option value="Ailier Droit">Ailier Droit</option>
                            <option value="Ailier Gauche">Ailier Gauche</option>
                            <option value="Milieu Central">Milieu Central</option>
                            <option value="Avant-Centre">Avant-Centre</option>
                            <option value="Milieur Offensif">Milieur Offensif</option>
                            <option value="Attaquant de Pointe">Attaquant de Pointe</option>
                        </select>
                    </div>

                    <div>
                        <label for="club"> Club Actuel</label>
                        <input type="text" required name="club" id="club">
                    </div>

                </div>


                <div class="portion">

                    <div>
                        <button name="bouton_envoi" id="bouton_suivant" >Suivant</button>
                    </div>
                </div>
            </div>
                
            <div>
                <p class="error"> <?= $error_sub_form; ?> </p>
            </div>

            <div>
                <a href="index.php" id="redirection"> Quitter </a>
            </div>
        </form>
        <script>
            function menu(){
                document.getElementById("menu").style.marginLeft = "0%";
            }
        </script>
    </body>
</html>
<?php