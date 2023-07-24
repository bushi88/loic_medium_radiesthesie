// comets & stars

// Récupération de la hauteur et de la largeur de la fenêtre du navigateur
var wH = window.innerHeight;
var wW = window.innerWidth;

// Récupération de l'élément 'body' du document
var domBody = document.body;

// fonction pour créer les comètes
(function (n) {
    // Tableaux contenant des valeurs de position et de délai pour les comètes
    var leftArr = [20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 60, 65, 70, 75, 80];
    var delayArr = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50];

    // Boucle pour créer le nombre spécifié de comètes (dans ce cas, 25)
    for (var i = 0; i < n; i++) {
        // Sélection aléatoire d'une valeur de position et de délai pour la comète
        var leftEle =
            leftArr[Math.floor(Math.random() * leftArr.length)] +
            parseFloat(Math.random().toFixed(2));
        var delayEle =
            delayArr[Math.floor(Math.random() * delayArr.length)] * 1000 +
            Math.round(Math.random() * 700);

        // Création de l'élément div pour représenter la comète
        var div = document.createElement("div");
        div.className = "star comet"; // Classe CSS pour la comète
        div.setAttribute(
            "style",
            "left:" + leftEle + "%;animation-delay:" + delayEle + "ms;"
        );

        // Ajout de la comète à l'élément 'body' du document
        domBody.appendChild(div);
    }
})(50); // Le nombre de comètes à créer est 50

// fonction pour créer les étoiles
(function (n) {
    // Boucle pour créer le nombre spécifié d'étoiles (dans ce cas, 150)
    for (var i = 0; i < n; i++) {
        // Création de l'élément div pour représenter l'étoile
        var div = document.createElement("div");
        // Attribution des classes CSS pour les différentes tailles d'étoiles
        div.className =
            i % 20 == 0
                ? "star star--big"
                : i % 9 == 0
                    ? "star star--medium"
                    : "star";

        // Positionnement et durée d'animation aléatoires pour chaque étoile
        div.setAttribute(
            "style",
            "top:" +
            Math.round(Math.random() * wH) + // Position verticale aléatoire
            "px;left:" +
            Math.round(Math.random() * wW) + // Position horizontale aléatoire
            "px;animation-duration:" +
            (Math.round(Math.random() * 3000) + 3000) + // Durée d'animation aléatoire entre 3000 et 6000 ms (3 à 6 secondes)
            "ms;animation-delay:" +
            Math.round(Math.random() * 3000) + // Décalage d'animation aléatoire jusqu'à 3000 ms (3 secondes)
            "ms;"
        );

        // Ajout de l'étoile à l'élément 'body' du document
        domBody.appendChild(div);
    }
})(150); // Le nombre d'étoiles à créer est 150