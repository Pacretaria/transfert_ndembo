var corps = document.getElementById("corps");
var connexion = document.getElementById("connexion");
var users = document.getElementById("conteneur");

function gestion_menu_me(x) {

    if (x === 'faled') {

        connexion.style.display = "block";
        corps.style.opacity = 0.5;

    }
    else if(x === 'succes'){
        users.style.display = "block";
        corps.style.opacity = 0.5;

        console.log('ok')
    } else {
        
    }
    
}



corps.addEventListener("click", function () {
    
    connexion.style.display = "none";
    users.style.display = "none";
    corps.style.opacity = 1;
});

function redirection(ref_match, x) {
    
    if (x === "succes") {
        
    }
    else{
        gestion_menu_me('faled');
    }

    window.location.href = "pari.php?ref=" + ref_match;
    
}


// JavaScript gestion formulaire connexion

var form_connexion = document.getElementById("connexion");
var phone = document.getElementById("telephone");
var pass = document.getElementById("mot_passe");

    form_connexion.addEventListener("submit", function (e) {
      
        e.preventDefault();

        if (phone.value !== "" || pass.value !== "") {

            envoyerDonnees(phone.value, pass.value);

        } else {

            document.getElementById("aide_connexion").textContent = "Remplissez le Formulaire";

        }
        form_connexion.reset();
        
    });

function envoyerDonnees(number, pass) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'connexion.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    const data = 'number='+number+'&pass='+pass; // Les données à envoyer
    xhr.send(data);
  
    xhr.onload = function() {
      if (xhr.status === 200) {
        const response = xhr.responseText;
        
        if (response === 'succes') {
            window.location.href = "?ref=ok";
        }
        
      } else {
        console.error("Une erreur s'est produite");
      }
    };
  }