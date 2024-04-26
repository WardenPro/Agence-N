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
- executer "composer require --dev doctrine/doctrine-fixtures-bundle"
- executer "php bin/console doctrine:database:create"
- executer "php bin/console doctrine:migrations:migrate"

ETAPES A FAIRE AVANT DE POURSUIVRE
 
- dans le fichier "src/DataFixtures/AppFixtures.php"
 
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']); // Assurez-vous d'utiliser le bon rôle
        $user->setNom('admin');
        $user->setPrenom('Administrateur');
        $encodedPassword = $this->hasher->hashPassword($user, 'admin123');
        $user->setPassword($encodedPassword);
 
        $manager->persist($user);
        $manager->flush();
    
 
A vous de modifier "admin@admin.com" en tant qu'username a votre guise, il sera créer instantanément et sera définitif.
A vous aussi de modifier "admin123" qui correspond au password.
Si aucun changement n'est effectué

- executer "php bin/console doctrine:fixtures:load"

:warning: **si vous accepter la prochaine question que fixtures pose la base de donnée sera purger et vous perdrez tout**: Faite très attention!
