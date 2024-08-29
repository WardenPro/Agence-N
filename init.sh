#!/bin/bash

LOCKFILE=/var/www/symfony/var/.init_done
MAX_ATTEMPTS=30
ATTEMPT=0

if [ ! -f "$LOCKFILE" ]; then
  echo "Initialisation du conteneur pour la première fois..."

  echo "Installation des dépendances Composer..."
  composer install --no-interaction --prefer-dist --optimize-autoloader

  echo "Installation du bundle doctrine/doctrine-fixtures-bundle..."
  composer require --dev doctrine/doctrine-fixtures-bundle

  echo "Création de la base de données..."
  php bin/console doctrine:database:create --if-not-exists

  echo "Execution de fixture"
  php bin/console doctrine:fixtures:load

  echo "Exécution des migrations..."
  php bin/console doctrine:migrations:migrate --no-interaction

  echo "Lancement du serveur"
  php -S 0.0.0.0:8000 -t public


  touch "$LOCKFILE"

  echo "Initialisation terminée."
else
  echo "Le conteneur a déjà été initialisé. Skipping."
fi

exit 0
