<?php
    
?>
<style>
    header{
        background-color: #770327;
        position: fixed;
        top: 0px;
        width: 100%;
    }
    #conteneur div{
        width:33.34%;
    }

    #logo{
        margin-left: 10%;
        color: black;
        font-family: calibri;
        font-size: 23px;
    }
    #menu_icon, #menu_icon_close{
        cursor: pointer;
        position: absolute;
        top:10px;
        left:40px;
        height: 80px;
    }
    #menu_icon_close{
        display: none;
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
        background-color:#f5a623;
        padding:5px 15px;
        font-size: 30px;
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
    #conteneur div ul{
        margin:30px 0px 0px 35%;
    }
    #conteneur div ul li{
        list-style:none;
    }
    #conteneur div ul li a{
        text-decoration:none;
        color: black;
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
        width: 20%;
        margin-left: -20%;
        height: 800px;
        background-color: white;
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
        border-bottom:2px solid #f5a623;
    }
    #menu nav li:hover{
        background-color: #f5a623;
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
</style>
<header>
    <nav>
        <div id="conteneur">
            <div id="logo">
                <p><img src="images/menu.png" width="5%" height="10%" alt="menu" id="menu_icon" onclick="menu()"> <img src="images/menu.png" width="5%" height="10%" alt="menu" id="menu_icon_close" onclick="menuClose()"><a href="index.php"><span><?php echo $_SESSION['prenom'] ?></span></p>
                <p style="margin-top:5px;"><?php echo $_SESSION['fonction'] ?></a></p>       
            </div>

            
            <div>
                <ul>
                    <li><a href="../deconnexion.php" class="deconnexion"> Déconnexion </a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="menu">
    <div>
        <nav>
            <ul>
                <li> <a href="recherche_precis.php"> Recherche avancée</a> </li>
                <li><a href="index.php"> Départements</a></li>
                <li><a href="comptes.php">Comptes</a></li>
                <li><a href="nouveau_compte.php">Créer un nouveau compte</a></li>
            </ul>
        </nav>
    </div>
</div>