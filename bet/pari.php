<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">

        <style>

            @media screen and (max-width: 950px){
                #bloc_pari{
                    width : 90%;
                    margin-left : 5%;
                }
            }

            @media screen and (max-width: 730px){
                #posibilite_pari h3{
                    width : 40%;
                    margin-left : 30%;
                }
            }
            @media screen and (max-width: 450px){
                #posibilite_pari h3{
                    width : 80%;
                    margin-left : 10%;
                    font-size:15px;
                }
                
                #bloc_pari .logo_club{
                    width: 60px;
                    height: 60px;
                }

                .club{
                    font-size: 13px;
                }

                .encadrement_pari div p{
                    font-size: 13px;
                }
                .encadrement_pari{
                    width: 100%;
                    padding: 0px;
                }
                select{
                    margin-left: 5%;
                }
            }
            @media screen and (max-width: 355px){
                select{
                    margin-left: 20%;
                }
                #apercus_pari{
                    font-size: 12px;
                }
                #apercus_pari input{
                    font-size: 15px;
                    height: 15px;
                }
            }
        </style>
    </head>
    <body>

        <div id="bloc_pari">
            <div id="presentation_match">
                <div> <img src="images/250284384_571383630544661_235066971897245249_n.jpg"  class="logo_club" alt="" >  <p class="club"> TP Mazembe</p> </div>
                <div class="score"> <span></span> - <span></span></div>
                <div> <img src="images/380668734_292205596900647_8429867390819398102_n.jpg" class="logo_club" alt=""> <p class="club"> Vita club</p> </div>
            </div>

            <div id="posibilite_pari">
                <h3> Parier Maintenant </h3>

                <form action="#">
                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Homme du Match </p>
                        </div>

                        <div>
                            <select name="homme_match" id="homme_match" onchange="detect_select('homme_match')">
                                <option value="">....</option>
                                <option value="azert;7;homme_match"> Meschack Teranga (Tp Mazembe) (x7) </option>
                                <option value="hfdser;9;homme_match"> Chadrack Luzerne (Tp Mazembe) (x9)</option>
                                <option value="hftr"> Messie Manitu (As Vita Club) (x8) </option>
                                <option value="trrd"> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Meilleur Buteur </p>
                        </div>

                        <div>
                            <select name="meilleur_buteur" id="meilleur_buteur" onchange="detect_select('meilleur_buteur')">
                                <option value="">....</option>
                                <option value="sdrt;14;meilleur_buteur"> Meschack Teranga (Tp Mazembe) (x14) </option>
                                <option value=""> Chadrack Luzerne (Tp Mazembe) (x4)</option>
                                <option value=""> Messie Manitu (As Vita Club) (x8) </option>
                                <option value=""> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Meilleur Milieu </p>
                        </div>

                        <div>
                            <select name="meilleur_milieu" id="meilleur_milieu"  onchange="detect_select('meilleur_milieu')">
                                <option value="">....</option>
                                <option value=""> Meschack Teranga (Tp Mazembe) (x7) </option>
                                <option value=""> Chadrack Luzerne (Tp Mazembe) (x4)</option>
                                <option value=""> Messie Manitu (As Vita Club) (x8) </option>
                                <option value=""> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Meilleur Défeseur </p>
                        </div>

                        <div>
                            <select name="meilleur_defenseur" id="meilleur_defenseur" onchange="detect_select('meilleur_defenseur')">
                                <option value="">....</option>
                                <option value=""> Meschack Teranga (Tp Mazembe) (x7) </option>
                                <option value=""> Chadrack Luzerne (Tp Mazembe) (x4)</option>
                                <option value=""> Messie Manitu (As Vita Club) (x8) </option>
                                <option value=""> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Meilleur Attaquant  </p>
                        </div>

                        <div>
                            <select name="meilleur_attaquant" id="meilleur_attaquant" onchange="detect_select('meilleur_attaquant')">
                                <option value="">....</option>
                                <option value=""> Meschack Teranga (Tp Mazembe) (x7) </option>
                                <option value=""> Chadrack Luzerne (Tp Mazembe) (x4)</option>
                                <option value=""> Messie Manitu (As Vita Club) (x8) </option>
                                <option value=""> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div class="encadrement_pari">
                        <div>
                            <p> <img src="images/ballon-de-football.png" class="ballon" alt=""> Meilleur Gardien  </p>
                        </div>

                        <div>
                            <select name="" id="">
                                <option value="">....</option>
                                <option value=""> Meschack Teranga (Tp Mazembe) (x7) </option>
                                <option value=""> Chadrack Luzerne (Tp Mazembe) (x4)</option>
                                <option value=""> Messie Manitu (As Vita Club) (x8) </option>
                                <option value=""> Danny Mapia ( As Vita Club) (x4) </option>
                                <option value=""> Chirack Kiala (Tp Mazembe) (x3) </option>
                            </select>
                        </div>
                    </div>

                    <div id="apercus_pari">
                        <div>
                            <p><input type="number" placeholder="mise" id="mise"></p>
                            <p> Total Cotes :</p>
                            <p> Total Gains :</p>
                        </div>

                        <div>

                            <p>  <span id="affichage_mise">00</span> fc</p>
                            <p> <span id="cotes"> 00 </span> xx</p>
                            <p> <span id="gain"> 00 </span> fc</p>
                        </div>
                    </div>

                    <div>
                        <button type="submit">Placez votre Pari </button>
                    </div>



                    
                </form>
            </div>
        </div>
        <script src="js/creation_coupont.js"></script>
    </body>
</html>