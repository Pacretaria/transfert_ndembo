<?php

?>
<style>
    body{
        background-color: #590524;
        width: 100%;
    }
    #bloc_principal{
        width: 100%;
    }
    header{
        background-color: #770327;
        width: 100%;
        padding: 15px 0px;
        font-family: tahoma, arial black, calibri;
        position: fixed;
        left: 0px;
        bottom: 0px;
        z-index: 999;
    }
    header img{
        width:30px;
    }
    header img, a{
        color:white;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    header div a{
        margin-left: -15px;
    }
    #entete{
        display: flex;
        justify-content : space-around; 
    }

    

    @media screen and (max-width: 1000px){
        
        
    }

    @media screen and (max-width: 850px){
       
        
    }

    @media screen and (max-width: 700px){
        
        
    }

    @media screen and (max-width: 600px){
        header img{
            width:20px;
        }
        header a{
            font-size:10px;
            padding-left: 5px;
        }     
    }

    @media screen and (max-width: 500px){
        header div img{
            
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
        .bouton_accueil{
            padding-left: 5px;
        }
        .bouton_notification{
            padding-left: -15px;
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
        .bouton_accueil{
            padding-left: 5px;
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
    
</style>
<header>
    <nav>
        <div>
            <div id="entete">
                <div><img src="../logo/accueil (1).png" alt="ajouter" class="icon_menu_element"><a href="index.php"><span class="bouton_accueil"> Accueil</span></a></div>
                <div><img src="../logo/bouton-notifications.png" alt="ajouter" class="icon_menu_element"><a href="#"><span class="bouton_notification">Notification</span></a></div>
                <div><img src="../logo/bouton-ajouter.png" alt="ajouter" class="icon_menu_element"> <a href="publication.php?ref=<?php echo $ref_joueur; ?>"> Nouveau</a> </div>
                <div><img src="../logo/rechercher.png" alt="ajouter" class="icon_menu_element"> <a href="#"> Recherche</a></div>
                <div><img src="../logo/compte.png" alt="ajouter" class="icon_menu_element"> <a href="voir_profil_joueur.php?joueur=<?php echo $ref_joueur; ?>"> Compte </a></div>
            </div>

        </div>
    </nav>
</header>

<div id="menu">
    

</div>