
# Agence N - Gestion des Notes de Frais et des Demandes de Congés

### Workshop - du 22/04/24 au 26/04/24

---

## Cahier des Charges

**Objet :**  
L'agence N souhaite numériser son système de gestion des notes de frais et des demandes de congés. Actuellement, cette gestion est réalisée via des documents *Excel* ou *Word* envoyés par email aux services concernés. L'objectif est de créer une plateforme où chaque employé pourra se connecter pour remplir des formulaires numériques, remplaçant ainsi les documents actuels.

### Fonctionnalités Principales

- **Gestion des Formulaires** : Chaque employé peut remplir et soumettre des formulaires de notes de frais et de demandes de congés via la plateforme.
- **Conservation des Données** : Les données collectées sont stockées dans une base de données et transmises aux services concernés via des notifications.
- **Consultation et Validation** : Les demandes peuvent être consultées, validées ou refusées par les services habilités (RH, Secrétariat).
- **Notifications** : Les expéditeurs des demandes reçoivent une notification pour connaître le statut de leur demande (validée ou refusée).
- **Export des Données** : Les demandes peuvent être exportées sous forme de tableau récapitulatif au format *Excel*.
- **Gestion des Rôles** : Accès sécurisé avec des rôles différents (visiteur, compta, RH, admin) pour accéder aux fonctionnalités spécifiques.

---

## Accès et Liens Disponibles

### Liens pour un "Visiteur"

- **/index** : Page d'accueil.

### Liens pour un "Compta"

- **/demande_conge** : Panneau des demandes de congés.
- **/mes_conge** : Informations sur les congés personnels.
- **/frais** : Informations concernant les frais.

### Liens pour un "RH"

- **/demande_conge** : Panneau des demandes de congés.
- **/mes_conge** : Informations sur les congés personnels.
- **/choix_conge** : Acceptation ou refus des demandes de congés.
- **/frais** : Informations concernant les frais.

### Liens pour un "Admin"

- **/login** : Connexion en tant qu'admin.
- **/all** : Accès illimité à toutes les ressources de l'application.

---

## Préparation du Projet

### Sans Docker

1. Installer les dépendances :  
   ```bash
   composer install
   ```

2. Installer le bundle `doctrine/doctrine-fixtures-bundle` :  
   ```bash
   composer require --dev doctrine/doctrine-fixtures-bundle
   ```

3. Créer la base de données :  
   ```bash
   php bin/console doctrine:database:create
   ```

4. Exécuter les migrations :  
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

### Avec Docker

1. Construire les services :  
   ```bash
   docker compose build
   ```

2. Démarrer les services :  
   ```bash
   docker compose up -d
   ```

3. Exécuter le script d'initialisation :  
   ```bash
   docker exec -it [nom_du_conteneur_php probably agence-n-www-1] bash /var/www/symfony/init.sh
   ```

4. Lancer le serveur Symfony :  
   ```bash
   php -S 0.0.0.0:8000 -t public
   ```

---

## Étapes Préliminaires

### Configuration des Fixtures

Avant de charger les fixtures, modifiez le fichier `src/DataFixtures/AppFixtures.php` :

```php
$user = new User();
$user->setEmail('admin@admin.com');
$user->setRoles(['ROLE_ADMIN']); // Assurez-vous d'utiliser le bon rôle
$user->setNom('admin');
$user->setPrenom('Administrateur');
$encodedPassword = $this->hasher->hashPassword($user, 'admin123');
$user->setPassword($encodedPassword);

$manager->persist($user);
$manager->flush();
```

Vous pouvez personnaliser les champs suivants :

- **Email** : Changez `'admin@admin.com'` par l'email de votre choix.
- **Mot de Passe** : Changez `'admin123'` par le mot de passe souhaité.

### Chargement des Fixtures

1. Chargez les fixtures dans la base de données :  
   ```bash
   php bin/console doctrine:fixtures:load
   ```

   **Attention :** Répondre "yes" à la question suivante entraînera la purge de la base de données, ce qui supprimera toutes les données existantes. Soyez vigilant !

---

## Conclusion

Ce projet est conçu pour fournir une interface intuitive et sécurisée pour la gestion des notes de frais et des demandes de congés au sein de l'agence N. L'accent a été mis sur l'expérience utilisateur et la facilité d'accès aux fonctionnalités essentielles.

---

**Note :** Aucun guide graphique n'est fourni, mais une attention particulière doit être portée à l'interface utilisateur pour garantir une expérience fluide et agréable.

---

## Annexes

### Exemple de fichier : note de frais actuel

![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 001](https://github.com/WardenPro/Agence-N/assets/45292453/a9aabcda-616a-407e-96ad-72ef93b13d50)

### Exemple de fichier : demande de congés actuel

![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 002](https://github.com/WardenPro/Agence-N/assets/45292453/e935fc0b-52ce-4e32-962b-7ef274c8e4a3)

![Aspose Words 84a390af-7f09-44af-b464-a021fe3528bb 003](https://github.com/WardenPro/Agence-N/assets/45292453/303ef7ab-2896-4f51-b093-f17fd656add1)
