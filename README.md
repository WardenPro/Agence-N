INSTRUCTION :
![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 001](https://github.com/WardenPro/Agence-N/assets/45292453/a9aabcda-616a-407e-96ad-72ef93b13d50)


Ecole 89

Workshop – du 22/04/24 au 26/04/24

Cahier des charges : Agence N

Objet : Traitement des notes de frais et demandes de congés

L’agence N. souhaite numériser son système de gestion de notes de frais et de demandes de congés.

Actuellement, cette gestion se fait à travers des documents *excel* ou *word* envoyés par mail aux services concernés. Vous trouverez en annexe un exemplaire de ces documents.

L’objectif est de mettre à disposition de l’agence N. une plateforme sur laquelle chaque employé pourra se connecter et remplir directement des formulaires qui remplaceront ls documents *word* et *excel* actuels. Les données ainsi récoltées seront bien sûr conservées et trasmise aux services concernés via des notifications consultables sur la plateforme par les personnes habilitées.

En effet toutes ces demandes pourront être consultées par les employés habilités (en principe les services RH et secrétariat). Les demandes pourront alors être validées ou refussées : une notification sera alors envoyée aux expéditeurs des demandes pour leur signifier la réponse.

Ces demandes seront présentées dans un format lisible, et pourront faire l’objet d’un export sous la forme d’un tableau récapitulatif au format *excel.* Une connexion sera bien sûr nécessaire pour accéder à ces fonctionnalités. Certaines personnes pourront aussi bénéficier d’un rôle plus avancé pour pouvoir supprimer ces données.

Aucune charte graphique n’est fournie, mais le site devra faire l’objet d’un soin attentif en matière de visuel et d’expérience utilisateur.

Annexes

Le fichier : note de frais actuel

![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 002](https://github.com/WardenPro/Agence-N/assets/45292453/e935fc0b-52ce-4e32-962b-7ef274c8e4a3)

Le fichier demande de congés actuel

![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 003](https://github.com/WardenPro/Agence-N/assets/45292453/303ef7ab-2896-4f51-b093-f17fd656add1)

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

:warning: **si vous dite yes à la prochaine question que fixtures pose la base de donnée sera purger et vous perdrez tout**: Faite très attention!
