
var coupon = [];
var cotes = [0, 0, 0, 0, 0, 0];
var mise ;
var total = 0;

var homme_match ;
var meilleur_buteur;
var meilleur_milieu;
var meilleur_defenseur;
var meilleur_attaquant;


function detect_select(x){

    chaine_brute = document.getElementById(x);
    
    valeur =  chaine_brute.value.split(';');

    switch (valeur[2]) {

        case 'homme_match':

            homme_match = valeur[0];
            cotes[0] = Number(valeur[1]);

            document.getElementById("cotes").value = (cotes[0]);
            //console.log(document.getElementById("cotes").value);
            document.getElementById("cotes").innerText = (cotes[0]);
        break;

        case 'meilleur_buteur':

            homme_match = valeur[0];
            cotes[1] = Number(valeur[1]);

            
            document.getElementById("cotes").value = ((cotes[0] + cotes[1]));
            //console.log(document.getElementById("cotes").value);
            //console.log(cotes[0] + cotes[1]);
            document.getElementById("cotes").innerText = (cotes[0] + cotes[1]);
        break;

    }
    
}

var champ_mise = document.getElementById('mise');
    champ_mise.addEventListener('blur', function (e) {
        
        mise = champ_mise.value;

        total = (cotes[0] + cotes[1]) * mise;

        document.getElementById('affichage_mise').textContent = total;
    })



