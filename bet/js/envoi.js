// JavaScript
var form_connexion = document.getElementById("connexion");
var phone = document.getElementById("telephone");
var pass = document.getElementById("mot_passe");

    form_connexion.addEventListener("submit", function () {
      
        console.log('ok');
        
    });

function envoyerDonnees(number, pass) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'traitement.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    const data = 'nom=John&prenom=Doe'; // Les données à envoyer
    xhr.send(data);
  
    xhr.onload = function() {
      if (xhr.status === 200) {
        const response = xhr.responseText;
        console.log(response); // Afficher la réponse du serveur
        // Mettre à jour l'interface utilisateur en fonction de la réponse
      } else {
        console.error("Une erreur s'est produite");
      }
    };
  }