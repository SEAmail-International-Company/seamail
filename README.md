# SEAmail - par SEAmail Int. Company

Nouvelle version de **l'historique** site de SEAmail (Projet BDD 2)

SEAmail c'est **SEAsimple**, SEAmail, c'est **SEAcurisé** !

**Une seule adresse de connexion** : [https://samsam.go.yo.fr](https://samsam.go.yo.fr)

---

## Installation

Utilisateur créé par défaut :

- username : ClaudeGodard
- mot de passe : MonsieurGodard54500@

Procédure d'installation (Windows sous Uwamp) :

- ouvrir un terminal (cmd ou powershell) `(Win + R) -> cmd.exe`
- se rendre dans le dossier de son serveur local  `cd C:\wamp64\www`
- cloner le dépôt en local dans son dossier www `git clone https://github.com/SEAmail-International-Company/seamail.git`
- ouvrir le dossier cloné (seamail) dans un éditeur de texte (type VSCode)
- ouvrir le fichier `sql -> init_db.sql` puis copier son contenu (Ctrl + A -> Ctrl + C)
- ouvrir l'interface locale de PhpMyAdmin (disponible à l'adresse `http://localhost/phpmyadmin`)
- sans sélectionner de base de données, se rendre dans l'onglet SQL (dans le menu du haut) puis coller le contenu sélectionné préalablement (Ctrl + V)
- le site devrait normalement être accessible et fonctionner à l'adresse `http://localhost/seamail/index.php`

**Etapes facultatives** (si utilisation d'un autre SGBD ou si l'utilisateur par défaut a été modifié)

- ouvrir le fichier `php -> connect_database.php`
- modifier les paramètres de connexion en fonction de votre SGBD
- réessayer d'accéder au site via votre navigateur à l'adresse `http://localhost/seamail/index.php`

---

## Technologies utilisées

[PHP](https://www.php.net/) : `8.0.1`

[JQuery (Google CDN)](https://jquery.com/) : `3.6.0`

[Font Awesome](https://fontawesome.com/) : `5.15`

[Bulma (CDN)](https://bulma.io/): `0.9.3`
