var response ;
var xhr = new XMLHttpRequest();
    xhr.open('GET', 'recuperation_videos.php', true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status <= 300) {

            response = JSON.parse(xhr.responseText);

            console.log(response[0]);
        } else {

            console.log('la requete a echouer avec le statue : '+ xhr.status);
            
        }
    };

    xhr.send();