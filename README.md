# ComptaSup API

Ce projet est une API développée avec Laravel pour le projet ComptaSup. Cette API permet la gestion des données comptables pour les utilisateurs autorisés. Ce guide vous aidera à configurer et lancer le projet sur votre machine locale.

## Prérequis
Avant de lancer le projet, assurez-vous que les éléments suivants sont installés sur votre machine :

- **Docker Compose ou Docker Desktop**
- **PHP version 8.2 ou supérieure**
- **Composer (pour la gestion des dépendances PHP)**

( vous pourrez dans certain cas avoir à configurez php cf. php.ini )

## Installation 

Clonez le dépôt :

```git clone https://github.com/ZachFrechin/comptasup_api.git```
```cd comptasup_api```

Installez les dépendances PHP avec Composer :

``composer install``

Créez un fichier .env en copiant le modèle :

``cp .env.example .env``

configuer le ficher .env a vos besoins

Configurez les variables d'environnement dans le fichier .env pour la connexion à la base de données. Assurez-vous que DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME et DB_PASSWORD correspondent aux paramètres de votre base de données.

## Lancer le projet

Pour démarrer le projet, suivez ces commandes :

Démarrez les services MySQL et PHPMyAdmin avec Docker Compose :

``docker compose up -d``

Note : Cette commande lancera MySQL et PHPMyAdmin en mode détaché. Vérifiez que les ports sont disponibles et bien configurés.


Le serveur devrait maintenant être accessible sur http://127.0.0.1:8000.
( fonctionne sur un serveur nginx )

## Utilisation
Après avoir lancé le projet, vous pouvez accéder à l'API en utilisant un client REST comme Postman ou cURL. Consultez la documentation de l'API pour plus d'informations sur les routes disponibles.

## Contribution
Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour suggérer des améliorations ou signaler des bugs.