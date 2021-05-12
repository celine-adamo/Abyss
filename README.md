# Framework à la main MVC PHP POO (avec exemple)

## Introduction

Ce dépôt GitHub est la version du framework "à la main" MVC PHP POO que nous avons créé ensemble (Quelques petites améliorations y ont été apporté). Je vais essayer de ce README de vous rappellez comment celui-ci fonctionne.

## La structure

* Le fichier index.php à la racine. Ce fichier est le point d'entrée de notre site. C'est dans ce fichier que nous utilisons AltoRouter afin de définir nos différentes routes.

* Un fichier .htaccess qui nous sert pour la réécriture d'URL (**ne pas y toucher**).

* Le dossier vendor (**ne pas y toucher**) contient les dépendances PHP de notre site (on ne versionne pas ce dossier, seulement les fichiers composer.json et composer.lock). Nous avons configuré notre autoloading des classes PHP dans le fichier composer.json avec le standard psr-4.

* Le dossier src contient notre code source (son namespace est App). Il contient 3 sous-dossiers (que vous pourrez organiser encore en sous-dossiers par la suite si vous le désirez) : 
    * Le dossier Controllers qui contient nos différents Controllers qui héritent tous de GeneralController.php afin que tous puissent facilement utiliser Twig.
    * Le dossier Models qui contient nos différents Models qui héritent tous de GeneralModel.php afin que tous puissent facilement utiliser PDO.
    * Le dossier View qui contient nos templates Twig.

* Le dossier config qui contient la configuration de notre site (son namespace est Config).Il ne contient qu'un fichier Config.php. Cette classe abstraite contient des constantes qui sont nécessaires au fonctionnement de notre site : les informations pour accéder à la base de données ainsi que l'URL de base de notre site. Grâce aux méthodes statiques de cette classe, nous pouvons obtenir ces informations.

* Le dossier assets qui contient (comme à notre habitude), les fichiers CSS, JavaScript et les images de notre site.

## Twig

Twig nous servira pour faire nos vues. Twig permet d'avoir une syntaxe plus propre que l'ouverture et fermeture de balises PHP dans nos templates.
La documentation de Twig : [ici](https://twig.symfony.com/doc/3.x/)

## Router

Nous utilisons AltoRouter comme router pour notre site. La documentation d'AltoRouter : [ici, dans la partie "Using AltoRouter"](https://altorouter.com/).
Pour votre curiosité, voici une vidéo de Grafikart présentant comment il créé [son Router](https://www.youtube.com/watch?v=I-DN2C7Gs7A&ab_channel=Grafikart.fr) à la main. La vidéo est complexe.

Pour créer une route, il faut toujours le faire dans le fichier index.php. Cela se fait grâce à la méthode map() d'AltoRouter. Voici comment elle fonctionne (nous allons voir les 3 arguments que l'on va passer à la méthode pour que celle-ci fonctionne) :  
* Le premier argument à passer à map est une chaîne de caractère représentant la méthode HTTP que l'on souhaite utiliser : "GET" ou "POST" (on utilisera "POST" pour les soumissions de formulaire et "GET" pour le reste). 
* Le deuxième argument à passer est le nom de notre route. Ce nom de route commencera toujours au minimum par un slash (/). D'ailleurs la route "/" est le point d'entrée de notre site. 
* Le troisième argument à passer à AltoRouter est une fonction de callback. Cette fonction sera déclenché lorsque l'on sera sur la route appelée. Dans cette fonction, nous instancierons un de nos Controller et nous appelerons une méthode de notre Controller. Si jamais nous avons une route qui dépend d'un paramètre dans l'URL (exemple : un id) nous pourrons spécifier ce paramètre dans notre route et nous en servir en argument dans la fonction de callback et le passer également dans la méthode de notre Controller. La documention d'AltoRouter parlant de [comment spécifier un paramètre dans l'Url](https://altorouter.com/usage/mapping-routes.html).

## Controllers

Nous pouvons organiser nos Controllers comme bon nous semble. Il est pertinent de créer des classes de Controller qui regroupe les mêmes pages que nous pourrions appeler, par exemple un AdminController pour gérer les routes concernant l'administration.

## Models

Nous pouvons organiser nos Models comme bon nous semble. Il est pertinent de créer des classes de Model regroupées pour les requêtes sur les mêmes tables de la base de données, par exemple un MovieModel pour gérer les requêtes SQL concernant les films.

## Utilisation

Après qu'un membre de l'équipe est créé le dépôt GitHub du projet, il faut ajouter chaque membres de l'équipe comme collaborateur sur le dépôt GitHub. Le premier membre mets tout en place PUIS les autres font un git clone. 
Commencer par renommer le fichier ConfigExemple.php dans le dossier config en Config.php avec les informations pour que cela fonctionne chez vous. 
Vous pourrez ensuite supprimer le fichier crud.sql qui ne sert que pour cette exemple.
Enlevez les routes d'exemple du fichier index.php (indiqué entre commentaires) ainsi que les "use" des Controllers d'exemple (indiqué de même). Un session_start(); est présent en commentaire dans le fichier index.php, je vous conseille de le garder, puis de le décommenter. Tout le site "sera toujours sur le fichier index.php", de ce fait, il est plus simple de gérer la session en la démarrant dans ce fichier plutôt que dans les Controllers. Supprimer tout le contenu du dossier Views puis organiser le comme bon vous semble avec notamment des sous dossiers ! (je vous conseille l'usage d'un fichier type template.html.twig). Ensuite supprimer tout le contenu du dossier src/Controllers sauf le fichier GeneralController.php. De même tout le contenu du dossier src/Models sauf le fichier GeneralModel.php. 
N'oubliez pas de faire un composer install avec le projet que vous aurez cloné.
Une fois vous différents dossiers et sous-dossiers non vides, vous pourrez supprimer les fichiers .gitkeep (il ne serve uniquement qu'à versionner des dossiers vides avec Git).
Pour la suite, il faut se répartir les tâches et travailler de manière collaborative (notamment en utilisant les channels créés sur le chat à cet effet).
Lisez bien les feedback de Git et GitHub et basez également sur cette exemple simple.
Pour l'utilisation de Git, je vous recommande la ["méthode git flow"](https://www.atlassian.com/fr/git/tutorials/comparing-workflows/gitflow-workflow#:~:text=Le%20workflow%20Gitflow%20global%20est,cr%C3%A9%C3%A9es%20%C3%A0%20partir%20de%20develop%20.) (d'autres ressources : [ici](https://danielkummer.github.io/git-flow-cheatsheet/index.fr_FR.html) et [là](https://www.youtube.com/watch?v=ZQAQ4HcskAY&ab_channel=Grafikart.fr)), **OU** alors d'avoir une approche similaire : avoir une branche main de base, une branche develop créée à partir de main au début du projet et plusieurs branches de features. Chacun travaille sur une branche du type "feature/index" ou "feature/edit-movie", puis de merger sur develop (des Pull Request peuvent vous aider).