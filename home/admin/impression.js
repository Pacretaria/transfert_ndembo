onload = function(){
    var impression = document.getElementById("impression");
    var barre = document.getElementById("recherche_precis");
    var entete = document.querySelector("header");
    var tablau = document.querySelector("table");

    impression.addEventListener("click", function (e) {
        e.preventDefault();

        barre.style.display = "none";
        entete.style.display = "none";
        tablau.style.marginLeft = "0px";
        tablau.style.width = "100%";

        console.log('click');
        window.print();
    });
}