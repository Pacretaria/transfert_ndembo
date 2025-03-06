
var xhr = new XMLHttpRequest();
    xhr.open('GET', 'recuperation_videos.php', true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status <= 300) {

            var response = JSON.parse(xhr.responseText);
             

            var video = document.getElementById("video_joueurs");
            var i = 0;
            video.src = "../publications_videos/"+ response[i];
        
            var bouton_suivant = document.getElementById('bouton-suivant');
            var bouton_jouer = document.getElementById('bouton-jouer');
            var bouton_rejouer = document.getElementById('bouton-rejouer');
        
            var etatVideo = "play";
        
            function leture() {
                if (etatVideo === "play") {
        
                    video.pause();
        
                    etatVideo = "pause";
        
                    bouton_jouer.style.display = "block";
                    bouton_rejouer.style.display = "block";
                    bouton_suivant.style.display = "block";
                } else {
        
                   video.play();
        
                    bouton_jouer.style.display = "none";
                    bouton_rejouer.style.display = "none";
                    bouton_suivant.style.display = "none";
        
                    etatVideo = "play";
                }
            }
        
            video.addEventListener('ended', function () {
                bouton_jouer.style.display = "block";
                bouton_rejouer.style.display = "block";
                bouton_suivant.style.display = "block";
            })
        
            video.addEventListener('click', leture);
        
            video.addEventListener('load', function () {
                video.play();
            });
        
            bouton_jouer.addEventListener('click', function () {
        
                bouton_jouer.style.display = "none";
                bouton_rejouer.style.display = "none";
                bouton_suivant.style.display = "none";
        
                video.play();
                etatVideo = "play";
            });
        
            bouton_rejouer.addEventListener("click", function(){
        
                video.currentTime = 0;
                video.play();
            });

            bouton_suivant.addEventListener("click", function () {

                if (i >= 0 && i < (response.length)) {
                    
                    video.src = "../publications_videos/"+ response[i];

                    i ++;
                } else {
                    i = 0;
                }
            });
        
            } else {

                console.log('la requete a echouer avec le statue : '+ xhr.status);
            
            }
        };

        xhr.send();



//detection de sweep
