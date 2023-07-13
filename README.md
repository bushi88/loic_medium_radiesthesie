## loic_medium_radiesthesie

    Loic_medium_radiesthesie est un site spécialisé dans la radiesthésie.
    En plus de fournir des informations sur cette pratique, le site propose également des services de consultation et une prise de rendez-vous.


## ⚙️ Installation

    Copiez le fichier .env et renommez-le .env.local
    Modifiez les variables d'environnement dans le fichier .env.local en fonction de votre configuration

    Installez les dépendances avec Composer install
    Créez la base de données php bin/console doctrine:database:create
    Générez un fichier de migration  php bin/console make:migration
    Effectuez les migrations php bin/console doctrine:migrations:migrate
    Chargez les fixtures php bin/console doctrine:fixtures:load


## Utilisation

    Lancez le serveur Symfony symfony server:start
    Rendez-vous sur http://localhost:8000


## Fonctionnalités

    Inscription et connexion des utilisateurs
    Interface pour l'administration du site