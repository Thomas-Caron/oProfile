# Installation du projet oSailing

1. Installer les dépendances avec la commande `composer install`
2. Créer le fichier de configuration à partir du fichier `wp-config-sample.php` avec la commande `cp -n wp-config-sample.php wp-config.php`
3. Compléter le fichier de configuration :
    - Connexion à la base de données (créer une nouvelle base de données si nécessaire)
    - Les clés de salage
    - L'URL vers la page d'accueil du site
4. Donner les bons droits aux dossiers et fichiers de l'application avec les commandes

```bash
sudo chgrp -R www-data .
sudo find . -type f -exec chmod 664 {} +
sudo find . -type d -exec chmod 775 {} +
sudo chmod g-w .htaccess
```

5. Importer la base de données (jeu de données) `data/oprofile.sql`

6. Générer les assets avec la commande `composer run-script build-theme-assets`
7. Générer l'autoload des plugins avec la commande `composer run-script dump-plugins-autoload`
