# Projet  Labella Business

## Ce que nous avons vu:

### Git

Après avoir cloné le repository (git clone "nom du repo")

il faut:

1- Ajouter les fichiers

2- "Commiter" les modifications

3- Pousser nos modifications en ligne

```
git add .
git commit -m "mon commit"
git push
```

---

### Configuration

1- Le fichier .env est un fichier de configuration "par défaut". Il ne faut pas le modifier directement mais le copier et le renommer:

```
.env.local
```
Ce nouveau fichier contiendra des informations sensibles qui ne seront pas "commit" et ne se retrouveront pas dévoilé au public.

---


## La console Symfony

elle permet d'exécuter des commandes propres à symfony (migrations, création de controllers, entités, etc.). C'est magique!

### Comment l'utiliser ?

```
php bin/console < ma commande >

// Par exemple

php bin/console make:controller

```

Il est possible de lister toutes les commandes disponnibles en faisant

```
php bin/console 
```

---

## Les controllers

Un controller regroupe un ensemble de routes. Lorsqu'on crée un controller il faudra regroupper les routes qui ont permettent d'agir sur la même fonctionnalité.
Par exemple, si on souhaite développer une fonctionnalité visant à créer, lire, éditer des articles, on créera un controller **ArticleController**.

Dans ce controller on y créera des **méthodes** correspondant aux différentes routes:

```php
#[Route('/article/edit', name: 'article_edit')]
public function edit(){
    //...code...
}

#[Route('/article/read', name: 'article_read')]
public function read(){
    //...code...
}

#[Route('/delete', name: 'article_delete')]
public function delete(){
    //...code...
}
```

---

## Doctrine 

C'est notre ORM qui va gérer les accès à la BDD. Pour configurer les accès ça se passera du côté du fichier 
**.env.local**

Une fois configuré, il faudra exécuter la commande de la console symfony:

```bash
php bin/console doctrine:database:create

# ou l'alias 

php bin/console d:d:c
Created database `symfo_lb` for connection named default
```

---

## Créer l'entité User

On va se laisser guider par la console!

```bash
php bin/console make:user
```

Après avoir suivi les étapes de la console, deux fichiers sont apparus
```bash
    src\Entity\User.php
    src\Repository\UserRepository
```

Ce sont les fichiers qui correspondent à notre **Model**. Après avoir créé ces fichiers, il va falloir mettre ç jour notre base de données. Pour ça il faut générer un fichier de migrations qui contient les requêtes SQL puis les exécuter.

```bash

php bin/console make:migration
php bin/console doctrine:migrations:migrate

```

Magie, la BDD est à jour!

On peut aussi passer la génération de migration, si on est fénéant mais attentions, ce n'est pas recomandé!

```
php bin/console doctrine:schema:update -f
```

---

## Le 5/03/2022

[Vers le replay](https://drive.google.com/file/d/13xZFXr36h7dvfEO2-t7AVA-41D28ZBX5/view?usp=sharing)

---


## Créer une commande

Nous allons créer une commande qui va nous permettre d'enregistrer des utilistateurs en base.
Une fois de plus nous allons utiliser le maker de Symfony

```bash

php bin\console make:command

```

On suit le guide comme d'habitude, en respectant la convention (user:create)
Pour en savoir plus, on peut aller voir la documentation de symfony sur les commandes.

Nous allons créer la commande user:create qui nous permettra de créer des utilisateurs en BDD. Plus tard nous améliorerons cette commande pour enregistrer des utilisateurs dynamiquement. Le fichier de commande se trouve dans:

```
src\Command\UserCreateCommand.php
```


## Créer le système d'authentification

Encore une fois, on va lancer la console de Symfony

```bash

php bin\console make:auth

```

On va demander un LoginForm Authenticator car nous souhaitons nous logger par formulaire. Symfony va créer pour nous 3 fichiers:
- SecurityController pour gérer les routes /login /logout
- login.html.twig qui sera le template contenant notre formulaire de connection
- LoginFormAuthenticator.php qui s'occupe d'authentifier l'utilisateur

Symfony va aussi mettre à jour le fichier security.yaml en créant un firewall. Son but sera de définir un moyen de se connecter à l'application.

## Création du backoffice

Grace à la console nous allons recréer un controller qui va gérer le backoffice.
Nous utiliserons l'annotation "IsGranted("ROLE_USER")" pour restreindre l'accès aux routes.

---

## Cours du 12/03
▶️[Lien vers le replay - partie 1](https://drive.google.com/file/d/1tXfcUPphr7JbInJM9DZt3l-RbI6ta2yF/view?usp=sharing)

▶️[Lien vers le replay - partie 2](https://drive.google.com/file/d/1sM9sJ23_lTJN8ZbVKZkIk6tVUeqwGzlN/view?usp=sharing)

---

Pour mettre en place webpack:

```shell

composer require symfony/webpack-encore-bundle
yarn install
```

Il va y avoir des nouveaux dossiers créés:
/assets -> c'est ici que nous placerons les assets du template
/node_modules -> c'est ici que sont téléchargées les dépendances JS

Pour utiliser webpack il faudra lancer un server avec la commande:
```
yarn encore dev-server
```

Pour ajouter un module js depuis le catalogue des package
```
yarn add nom_du_package

// par exemple pour bootstrap

yarn add bootstrap@4
```

Déplacer les assets du template dans le dossier templates pour ceux qui ne se trouve pas sur le web et bien penser à faire des imports dans le fichier assets/app.js.
Pour terminer, il faudra découper notre template en sous élements (header, body, footer, navbar, etc.) 
Et bien veiller à ce que chaque ressource (css ou js) soit importée

---
### Cours du 26/03/2022

▶️[Lien vers le replay](https://drive.google.com/file/d/14krATc43tEnr20iXz5JaBI9UXkae8mrT/view?usp=sharing)

Objectifs du jour: 

- Créer des requêtes asynchrones
- Gérer ses branches git (versionning), en bonus 

---

### Requêtes AJAX

Le but du jour est de poster notre formulaire sans avoir à recharger notre page.

#### Les controllers Stimulus
Stimulus est un module JS qui va nous simplifier la vie. Il va rechercher toutes les balises ayant comme attribut
"data-controller" pour y attacher un fichier

#### Les fichiers utiles:

▶️[contact_form.html.twig](templates/home/partials/contact_form.html.twig) - **ligne 20**

▶️[contact_form.html.twig](src/Controller/HomeController.php) - mise en place de la route pour traiter le formulaire en AJAX

▶️[contact_form.html.twig](assets/controllers/postform_ajax_controller.js) - mise en place du code JS pour gérer la soumission du formulaire en AJAX

---

### Cours du 02/04/2022

▶️[lien vers le replay](https://drive.google.com/file/d/1gb2-7JgL-W_RciqOXLvaops5dY5aV3E_/view?usp=sharing)

Objectif du jour: améliorer son backoffice

#### Etape 1: Concevoir un template dédié au backoffice

Nous allons récupérer un template bootstrap assez simpliste pour notre BO

▶️[Directement depuis la doc bootstrap](https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/)

Nous allons créer un template de base twig qui sera dédié au backoffice car le css et les librairies JS dont nous avons besoin sont différentes de la partie web dédiée aux visiteurs

Pour ça il faudra:

- Créer le fichier template/base_bo.html.twig (contenant le code HTML de base pour le backoffice)
- Créer le fichier assets/app_bo.js (qui contiendra les imports des librairies JS et CSS nécessaires)
- Copier le template depuis le site web bootstrap vers notre template twig et l'adapter

#### Etape 2: Gérer les messages reçus

Le principe ici va être de pouvoir administrer les messages, ainsi en tant qu'administrateur du site je veux pouvoir:

- Consulter les nouveaux messages
- Supprimer, archiver les messages
- (bonus avec l'étape 3) Répondre à nos message depuis le BO

#### Etape 3 (bonus): Mise en place du service mailer

Là c'est un peu plus long mais pas beaucoup plus compliqué, il va falloir configurer une boite mail et installer le service de messagerie correspondant dans notre application symfony.
Nous utiliserons gmail car il est gratuit et relativement facile à configurer.

Pour la configuration du mailer, il est vivement conseillé de consulter la [doc de symfony](https://symfony.com/doc/current/mailer.html) qui est très bien faite.

Il va donc falloir compléter notr **MAILER_DSN** notre fichier d'environnement [.env.local](.env.local)

Une fois terminé nous pouvons tester notre mailer.

Symfony met à nottre dispisition le mailer, disponible par injection de dépendance. Pour l'utiliser au sein d'un controller ou d'un service, je n'ai qu'à demander un **MailerInterface**. 
Symfony sra capable de sélectionner le mailer par défaut et le donner.

```php

#[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        // ...
    }
```

Il ne reste plus qu'à créer une route mettant à disposition un formulaire, qui lors de sa soumission, utilisera le mailer.

### Prochaine: Créer un readme







