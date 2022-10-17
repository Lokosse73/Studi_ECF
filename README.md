# Studi_ECF
## Ce projet est créé dans le cadre d'un examen de l'école STUDI


### Installation locale

1.Télécharger le dossier "Gym".

2.Glissé le dossier téléchargé dans votre serveur Web local. exemple C:\xampp\htdocs

3.Vous pouvez déjà utiliser l'application cependant le mail et mot de passe d'admin sont par défaut "studi-admin@gym.fr" et "1205" si vous voulez les changer :

  -avant d'utiliser l'app vous pouvez le faire en ouvrent le fichier "Gym\Script\Php\ConnectSQL.php" à la ligne 7 et 8.

  -si vous avez déjà utilisé l'app vous devrez vous rendre dans votre gestionnaire de base de données et modifier la première ligne de la table "connection".

Notez que vous pouvez aussi changer le nom de la base de donéess à la ligne 5 dans la constante "DB_NAME" dans le fichier "ConnectSQL.php" ouvert précédemment.

4.Vous pouvez maintenant utiliser votre application.


### Installation avec hébergeur

1.Télécharger le dossier "Gym"

2.Sur le site de votre hébergeur une fois connecté allez dans le tableau de bord de votre site et ouvrez le gestionnaire de base de données.

3.Créez une base de données, il vous sera demandé un nom d'utilisateur avec un mot de passe ainsi qu'un nom pour votre base de données.

4.Dans le dossier téléchargé ouvrez le fichier "Gym\Script\Php\ConnectSQL.php", dans l'ordre de la ligne 3 à 5 vous devrez renseigner le nom d'utilisateur, mot de passe et nom de votre base de données que vous avez utilisé à l'étape numéro 3.

5.Pour la connexion administrateur du site le mail et mot de passe d'admin sont par défaut "studi-admin@gym.fr" et "1205" vous pouvez les changer dans le même fichier à la ligne 7 et 8.

6.Une fois tout ceci fait vous pouvez aller dans le gestionnaire de fichiers de votre hébergeur ou par connexion FTP dans le fichier "public_html" et y ajouter tout le contenu du dossier "Gym".

7.Vous pouvez maintenant utiliser votre application.


#### Clément TARDIEU
