<style>
    body{
        margin: 0%;
        font-family: arial black;
        background-color: #c9c7c7;
    }
    header{
        background-color: #720817;
        height: 65px;
        width: 100%;
        border-top: 5px solid #f7b300;
    }
    #conteneur div{
        width:50%;
    }

    #logo{
        margin-left: 5%;
        margin-top: -20PX;
        color: black;
        font-family: calibri;
        font-size: 23px;
    }
    #logo p{
        margin:35px 0px 0px 15px;
    }#logo p a{
        margin-top: 15px;
        color: white;
        text-decoration: none;
        font : bold 18px nunito, sans-serif; 
    }
    
    #conteneur div{
        width: 50%;
    }
    #conteneur div ul, #conteneur{
        display: flex;
        justify: space-around;
    }
    #conteneur div ul{
        width: 60%;
        float: right;
    }
    #conteneur div ul li{
        list-style:none;
        width: 90%;
        text-align: right;
    }
    #conteneur div ul li a{
        text-decoration:none;
        color: white;
        font-size: 13px;
        margin-left: -15px;
    }
    .deconnexion{
        background-color: #ddd5d8;
        padding: 15px;
        color: white;
        transition-property: background-color;
        transition-duration: 0.3s;
        transition-delay: 0s;
    }
    .deconnexion:hover{
        background-color: #e9e6e7;
    }

    
    
    #logo_ndembo{
        margin: 0% 1%;
        width:17%;
        height: 60px; 
    }
    #conteneur #logo p{
        width: 100%;
    }
    
    
    #boutton_search{
        width: 8%;
        margin: 35px 0px 0px 10px;
        fill: white;
    }
    #bloc_principal div form{
        width: 50%;
        margin-left:50%;
    }
    #bloc_principal form input{
        width:100%;
        height: 40px;
        background: transparent;
        color: black;
        border-radius: 15px;
        margin-top: 40px;
        margin-left: -50%;
        border: none;
        border: 2px solid gray;
        opacity: 0.2;
        padding-left: 10px;
    }
    #search{
        border: 5px solid white;
    }
    h3{
        text-align: center;
        color: ;
    }
    h3 span{
        color: red;
    }
    #resultat{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 30px 0px 0px 0px;
    }
    .encadrement_resultat{
        align-self: center;
        width: 200px;
        background-color: #720817;
        color: white;
        border-radius: 5px;
        margin-left:2%;
        margin-bottom:4%;
    }
    .profil_joueurs{
        width:90%;
        margin:15px 5%;
        height: 160px;
    }
    .profil_joueurs_precis{
        width:40%;
        margin:15px 5%;
        height: 80px;
    }
    .encadrement_resultat p{
        font-size: 12px;
        width: 90%;
        margin:5px 5%;
    }
    .nom_joueurs{
        text-align: center;
    }
    .encadrement_resultat p span{
        float: right;
        color:#f7b300;
    }
    .encadrement_resultat a{
        font-size: 13px;
        display : block;
        width: 90%;
        margin:5px 5%;
        text-decoration: none;
        background-color: #f7b300;
        color: white;
        padding: 10px 0px;
        text-align: center;
        border-radius: 3px;
        margin-bottom: 10px;
    }
    .encadrement_resultat a:hover{
        background-color: transparent;
        border: 3px solid #f7b300;
        color: #f7b300;
    }

    /* Tableau recherche precise */

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

    @media screen and (max-width: 550px){
        #conteneur div ul li{
            width: 80%;
        }
        #conteneur div ul li a{
            text-decoration:none;
            color: #f7b300;
            font-size: 10px;
        }
        #bloc_principal h3 {
            font-size: 12px;
        }
    }
    @media screen and (max-width: 450px){
        #conteneur div ul li{
            width: 80%;
        }
        #conteneur div ul li a{
            text-decoration:none;
            color: #f7b300;
            font-size: 10px;
        }
        #bloc_principal h3 {
            font-size: 12px;
        }
    }
    @media screen and (max-width: 300px){
        #conteneur div ul li{
            width: 70%;
        }
        #conteneur div ul li a{
            text-decoration:none;
            color: #f7b300;
            font-size: 10px;
        }
        #bloc_principal h3 {
            font-size: 12px;
        }
        #form_search{
            width:100%;
        }
    }
    
    
</style>
<header>
    <nav>
        <div id="conteneur">
            <div id="logo">
                <p> 
                    <a href="../index.php">TRANSFERT NDEMBO</a> 
                </p>
            </div>

            <div>
                <ul>
                    <li> <a href="recherche_precis.php"> Filtrer </a></li>
                </ul>
            </div>

        </div>
    </nav>
</header>