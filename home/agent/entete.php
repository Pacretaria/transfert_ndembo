<?php
    
?>
<style>
    body{
        background-color: #ddd5d8;
    }
    header{
        background-color: #770327;
        height: 80px;
        font-family: tahoma, arial black, calibri;
    }
    #conteneur div{
        width:100%;
    }

    #logo{
        margin-left: 0%;
        margin-top: -20PX;
        color: black;
        font-family: calibri;
        font-size: 23px;
    }
    #logo a{
        text-decoration: none;
        color: #720817;
    }
    #logo p{
        font-size: 15px;
        margin:25px 0px 10px 0px;
        color: skyblue;
    }
    #logo span{
        display: block;
        margin:-60px 0px 0px 180px;
        font-size: 17px;
        border-radius: 2px;
        font-weight: bold;
        color: white;
    }
    #recherche form input{
        width:100%;
        height:40px;
        border:2px solid #ddd5d8;
        border-radius:20px;
        color: black;
        padding-left:10px;
        margin-top:23px;
        margin-left:-33px;
    }
    
    #conteneur div ul, #conteneur{
        display: flex;
        justify: space-around;
    }
    .deconnexion{
        background-color: #ddd5d8;
        padding: 15px;
        color: #3f3f41;
        transition-property: background-color;
        transition-duration: 0.3s;
        transition-delay: 0s;
    }
    .deconnexion:hover{
        background-color: #e9e6e7;
    }

    #menu{
        background-color: white;
        color: white;
        width: 40%;
        margin-left: -40%;
        height: 800px;
        position: fixed;
        z-index:2;
        padding: 0px;
        transition-property: margin-left;
        transition-duration: 0.3s;
        transition-delay: 0s;
    }
    #menu ul{
        margin-left:-40px;
    }
    #menu nav li{
        list-style: none;
        padding: 0px 0px 0px 15px;
        border-bottom:2px solid #ffaa01;
    }
    #menu nav li:hover{
        background-color: #ffaa01;
        color: white;
    }
    #menu nav li a{
        text-decoration:none;
        color: black;
        display: block;
        padding: 15px 0px;
    }
    #menu nav li a:hover{
        color: white;
    }
    #profil{
        width:70px;
        height:70px;
        border-radius: 50%;
        margin: -15px -40px 10px 290px;
    }
    nav ul li p{
        margin: 7px 0px 0px 60px;
        width: 100%;
        font-weight: bold;
        color: white;
    }
    
    #menu_icon_close_burger{
        display: none;
    }
    .menu-burger {
        width: 50px;
        height: 80px;
        margin: -5px 0px 7px 20px;
        color: white;
    }

    #profil_utilisateur{
        width: 65px;
        height: 60px;
        border-radius: 50%;
        margin: -17px 0px 17px 15px;
        position: absolute;
        top:28px;
        left: 75px;
        border : 2px solid #ffaa01;
    }
    
    #logo_ndembo{
        margin-left: 85%;
        margin-top: 2%;
        width:13%;
        height: 60px;
    }
    #conteneur #logo p{
        width: 100%;
    }
    .info{
        width: 100%;
    }
    .info div{
        width: 90%;
        margin-left: 5%;
        height: 20%;
        background-color: white;

    }
    .info div h2{
        color: #ffaa01;
        text-align: center;
        padding: 10% 0% 0% 0%;
        font-size: 50px;
    }
    .info div p{
        text-align: center;
        padding: 0% 0% 5% 0%;
        font-size: 15px;
        font-weight: bold;
    }
    .info div p img{
        width: 2.5%;
        height:2.5%;
    }
    .icon_menu_element{
        width: 3.5%;
        height:3.5%;
    }
    .profil_jouers{
        width:70%;
        height:100%;
        border-radius: 50%;
        border : 2px solid #ffaa01;
    }

    

    @media screen and (max-width: 1000px){
        #logo_ndembo{
            margin-left: 85%;
            margin-top: 2%;
            width:13%;
        }
        #menu{
            width: 30%;
        }
        .icon_menu_element{
            width: 3.5%;
            height:3.5%;
        }
    }

    @media screen and (max-width: 850px){
        #logo_ndembo{
            margin-left: 82%;
            margin-top: 2%;
            width:17%;
        }     
        .icon_menu_element{
            width: 10%;
            height:10%;
        }
        #form_enregistrement{
            width: 70%;
        }
    }

    @media screen and (max-width: 700px){
        #logo_ndembo{
            margin-left: 70%;
            margin-top: 2%;
            width:25%;
        }     
        .icon_menu_element{
            width: 10%;
            height:10%;
        }
    }
    
    @media screen and (max-width: 600px){
        #logo_ndembo{
            margin-left: 77%;
            margin-top: 2%;
            width:23%;
        }      
    }

    @media screen and (max-width: 600px){
        #logo_ndembo{
            margin-left: 55%;
            margin-top: 8%;
            width:40%;
            height: 50px;
        }
        #logo span{
            margin-left: 170px;
            font-size: 13px;
        }
        table{
            font-size:10px;
        }
        #profil_utilisateur{
            width: 45px;
            height: 40px;
            border-radius: 50%;
            margin: -8px 0px 17px -5px;
        }
        #logo span{
            margin-left: 130px;
            font-size: 15px;
        }      
    }

    @media screen and (max-width: 500px){
        #logo_ndembo{
            margin-left: 55%;
            margin-top: 8%;
            width:40%;
            height: 50px;
        }
        #logo span{
            margin-left: 170px;
            font-size: 13px;
        }
        table{
            font-size:10px;
        }
        #profil_utilisateur{
            width: 45px;
            height: 40px;
            border-radius: 50%;
            margin: -8px 0px 17px -5px;
        }
        #logo span{
            margin-left: 130px;
            font-size: 15px;
        }      
    }

    @media screen and (max-width: 450px){
        #logo_ndembo{
            margin-left: 65%;
            margin-top: 7%;
            width:31%;
        }
        
        .menu-burger {
            width: 35px;
            height: 80px;
            margin: -5px 0px 7px 20px;
            color: white;
        }
        #menu nav li a{
            padding: 10px 0px;
            font-size: 13px;
        }
        .info div h2{
            font-size: 35px;
        }
        .info div p{
            font-size: 10px;
        }
        .info div p img{
            width: 3%;
            height:3%;
        }
        table{
            font-size:10px;
        }
        #profil_utilisateur{
            width: 35px;
            height: 30px;
            border-radius: 50%;
            margin: -5px 0px 17px -15px;
        }
        #logo span{
            margin-left: 110px;
        }      
    }

    @media screen and (max-width: 400px){
        #logo_ndembo{
            margin-left: 50%;
            margin-top: 10%;
            width:50%;
            height: 50px;
        }
        .menu-burger {
            width: 35px;
            height: 80px;
            margin: -5px 0px 7px 20px;
            color: white;
        }
        #menu nav li a{
            padding: 10px 0px;
            font-size: 11px;
        }
        
        .info div p{
            font-size: 10px;
        }
        .info div h2{
            font-size: 30px;
        }
        .info div p img{
            width: 3%;
            height:3%;
        }
        table{
            font-size:10px;
        }
        #profil_utilisateur{
            width: 35px;
            height: 30px;
            border-radius: 50%;
            margin: -5px 0px 17px -15px;
        }
        #logo span{
            display: none;
        } 
    }

    @media screen and (max-width: 300px){
        #logo_ndembo{
            margin-left: 50%;
            margin-top: 10%;
            width:46%;
            height: 50px;
        }       
        .menu-burger {
            width: 35px;
            height: 80px;
            margin: -5px 0px 7px 20px;
            color: white;
        }
        #menu nav li a{
        padding: 10px 0px;
        font-size: 10px;
        }
        
        .info div p{
            font-size: 10px;
        }
        .info div p img{
            width: 3%;
            height:3%;
        }
        table{
            font-size:10px;
        }
        #profil_utilisateur{
            width: 35px;
            height: 30px;
            border-radius: 50%;
            margin: -5px 0px 17px -15px;
        }
        #logo span{
            display: none;
        }
    }



    /* Page recherhe standard */


    
    #boutton_search{
        width: 8%;
        margin: 35px 0px 0px 10px;
        fill: white;
    }
    #bloc_principal div form{
        width: 50%;
        margin-left:25%;
    }
    #bloc_principal form input{
        width:100%;
        height: 40px;
        background: #77032714;
        color: black;
        border-radius: 15px;
        margin-top: 40px;
        border: none;
        padding-left: 10px;
    }
    #search{
        border: 5px solid #ffaa01;
    }
    h3{
        text-align: center;
        color: ;
    }
    h3 span{
        color: red;
    }
    #resultat_recherche{
        width: 90%;
        margin-left: 5%;
        padding: 30px 0px 30px 15px;
        border-collapse: collapse;
        font-family: tahoma, arial black, calibri;
        font-size: 16px;
        
    }
    #resultat_recherche thead{
        background-color: #770327;
        color: white;
        border-bottom: 4px solid #ffaa01;
    }
    #resultat_recherche thead th{
        border: 1px solid #77032714;
        padding: 20px 0px;
    }
    #resultat_recherche tbody{
        background-color: white;
        font-size: 13px;
    }
    #resultat_recherche tbody td{
        background-color: white;
        border: 1px solid #77032714;
    }
    #resultat_recherche tbody td a{
        color: black;
        text-decoration: none;
    }
    #resultat_recherche tbody td a p{
        font-family: tahoma, arial black, calibri;
        font-weight: bold;
    }
    #resultat_recherche tbody td a p span{
        color: #770327;
        font-weight: none;
    }
    .profil_joueurs{
        width:20%;
        margin:5px 5%;
        height: 50px;
    }
    #resultat_recherche tbody td p{
        margin:-10px 0% -10px 22%;
    }
    #resultat_recherche tbody td img + p{
        margin:-43px 0px 25px 27% ;
    }
    .valeur_marchandes{
        text-align: right;
        padding-right: 20px;
    }
    
</style>
<header>
    <nav>
        <div id="conteneur">
            <div id="logo">
                <p> 
                    <img src="../logo/menu-svgrepo-com.svg" alt="menu" class="menu-burger" id="menu_icon_burger" onclick="menu()">
                    <img src="../logo/menu-svgrepo-com.svg" alt="menu" class="menu-burger" id="menu_icon_close_burger" onclick="menuClose()"> 
                    <a href="index.php"><img src="../media/<?php echo $_SESSION['profil'] ?>" id="profil_utilisateur" alt="profil"> </a>
                    <span id="infos_utilisateur"><?php echo $_SESSION['nom'].' '.$_SESSION['prenom'] ?></span>
                </p>
            </div>

            <div>
                <a href="index.php"><img src="../logo/logo.png" alt="menu" id="logo_ndembo"></a>
            </div>

        </div>
    </nav>
</header>

<div id="menu">
    <div>
        <nav>
            <ul>
                <li> <a href="enregistrement.php"> <img src="../logo/carre-plus.svg" alt="ajouter" class="icon_menu_element"> Joueur</a> </li>
                <li><a href="recherche.php"><img src="../logo/recherche-de-membres.svg" alt="ajouter" class="icon_menu_element"> Recherche</a></li>
                <li> <a href="modification_compte.php?reference_user=<?php echo $_SESSION['reference']?>"><img src="../logo/UTILISATEUR.svg" alt="ajouter" class="icon_menu_element"> Compte</a></li>
                <li> <a href="../deconnexion.php"><img src="../logo/du-pouvoir.svg" alt="ajouter" class="icon_menu_element"> Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</div>