DESCRIPTIF :
 
Ce projet réalisé en symfony a pour but d'afficher un système de gestion de notes de frais et de demandes
de congés :

- Page de connection a différent degrés
- Un formulaire : note de frais et demande de congé (données récoltées conservées
transmise aux BDD concernées)
- Notification au service RH / Compta et Validation
- Notification expéditeur et reçu demande
- Faire export d’un fichier html en excel (via une bibliothèque)
- Faire quelque chose de lisible

 
 
voici les liens disponibles pour un "visiteur" :
 
- (/index) => index

voici les liens disponibles pour un "compta" :
- (/demande_conge) => pannel demande de conge
- (/mes_conge) => information sur les conges de la personne 
- (frais) => information concernant les frais

voici les liens disponibles pour un "RH" :
- (/demande_conge) => pannel demande de conge
- (/mes_conge) => information sur les conges de la personne
- (/choix_conge) => accepter/refuser les congées
- (frais) => information concernant les frais

voici les liens disponibles pour un "admin" :
 
- (/login) => se connecter en admin
- (all) => accès illimité a toute les ressources du webapp
 
PREPARATION DU PROJET :
 
- executer "composer install"
- executer "php bin/console doctrine:database:create"
- executer "php bin/console doctrine:migrations:migrate"

Si aucun changement n'est effectué
