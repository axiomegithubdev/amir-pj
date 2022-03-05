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

## Créer une commande

Nous allons créer une commande qui va nous permettre d'enregistrer des utilistateurs en base.
Une fois de plus nous allons utiliser le maker de Symfony

```bash

php bin\console make:command

```

On suit le guide comme d'habitude, en respectant la convention (user:create)
Pour en savoir plus, []








