Matthias Larty  
Baptiste Brugoux  
Mickaël Degrémont  
Ewann Roux


# Question 1 

Créer un projet vide Symfony. Mettre en place webpack encore et bootstrap
dans votre projet. Créer votre fichier README.md au format markdown contenant les noms des
membres du groupes. Pensez à ajouter dans README.md les commandes Symfony utilisées pour
répondre à la question. Taguer votre dépôt avec l’étiquette Question 1. Pensez à toujours
taguer votre dépôt après avoir traité les questions suivantes !

```symfony new ProjetCC --webapp```  
```cd ProjetCC```  
```symfony composer require symfony/webpack-encore-bundle```  
```npm install```  
```npm install bootstrap```  
```npm install bootstrap-icons```

création du fichier twig.yaml et modification de app.js

```npm run dev```  
```composer require symfony/twig-bundle```

# Question 2

Créer l’entité leçon, la base de données et la table associée à cette entité.

```symfony console make:entity lecon```  
```symfony console m:mig```  
```symfony console d:m:m```

# Question 3

Créer une fixture pour remplir votre base de données en utilisant Faker.

```symfony composer require fakerphp/faker```  
```symfony composer require orm-fixtures --dev```  
```symfony console make:fixture```  
```symfony console doctrine:fixtures:load```

# Question 4

```composer require form validator security-csrf``` pas necessaire en cours mais le projet semble ne pas tout avoir par défaut / dépend de la plateforme de l'utilisateur
```symfony console make:crud Lecon```

#  Question 5 

Ajouter une barre de navigation. Adapter et embellissez votre application avec Bootstrap.  

Ajout de plusieurs fichiers twig "layers" et modifications des templates existant pour mettre en place des éléments bootstrap


# Question 6

Ajouter la possibilité d’écrire les descriptions au format markdown.


```symfony composer require cebe/markdown```  
ajout dans config/services.yaml du service :  
    cebe\markdown\Markdown: ~  
```symfony console make:twig-extension``` avec MarkdownExtension en argument  
modification les fichiers MarkdownExtension.php, MarkdownExtensionRuntime.php  
modification des fixtures et des templates  


# Question 7

Créer une entité User et lui associer un système d’authentification comprenant
un login et la création d’un compte. L’entité User aura les attributs nom et prénom. Par défaut,
un User a le rôle de professeur.

```composer require security```  
```symfony console make:user```  
```symfony console make:entity User``` 
```symfony console m:mig``` 
```symfony console d:m:m``` 
```symfony console make:auth```  
```symfony console make:registration-form```   
modifications de config/packages/security.yaml pour que l'authentification fonctionne
modification du Registration controleur pour assigner ROLE_PROFESSEUR à chaque User créé   
par défaut Symfony ajoute également ROLE_USER, ce comportement a été laissé pour l'instant  

# Question 8

Nous souhaitons enregistrer pour chaque leçon, le nom de l’unique professeur.
Créer cette relation entre l’entité leçon et l’entité User. Modifier votre fixture en conséquence.  


```symfony console make:entity Lecon``` ->  orphanRemoval activé   
suppression (fonction commentée mais fichier conservé) de l'ancien fichier de fixture Lecon, maintenant AppFixtures se chargera de créer un professeur ainsi que ses leçons.   
suppression manuelle de la DB car la non null contrainte empechait d'appliquer la migration  
```symfony console m:mig``` 
```symfony console d:m:m```  
```symfony console doctrine:fixtures:load```   


### Un crud user avait été créé lors de la question 7 pour aider à visualiser des éléments suite à des complications rencontrées, il sera supprimé/adapté au moment de répondre aux questions concernant la gestion d'utilisateur afin d'avoir un rendu final propre


# Question 9 

Faîte en sorte que la création d’une leçon ne soit possible que par un professeur connecté. Le professeur connecté devenant ainsi l’auteur d’une leçon.

modification de l'index du template de lecon pour n'afficher le bouton qu'à un professeur connecté  
ajout d'une annotation IsGranted pour bloquer l'accès à la route *app_lecon_new* si on n'a pas le role professeur dans  **LeconController** cette annotation redirige automatiquement sur la page de connection  
**LeconController** établit également la relation entre professeur et leçon lors d'une création  
modification du twig show et du layer _index_lecon pour afficher le nom du professeur qui a créé la leçon  

# Question 10 

Mettez en place les autres contraintes qui vous paraissent pertinentes.  

boutons modifier et supprimé affiché en show et index uniquement si on est le professeur assigné, route limité en accès aux professeurs et vérification en interne qu'on est le professeur créateur, dans le cas contraire on est redirigé sur la liste des leçons  
création du profil Prof2 dans la fixture pour tester ces changements  

# Question 11 

Embellissez votre application et pensez, si cela n’est pas déjà fait, à modifier
votre fixture. Afin de facilité le test de votre application, créer tous vos users de votre fixture
avec le mot de passe "secret".

retouche de la navbar, du formulaire de login et d'inscription, et de la page par défaut


# Question 12 
Offrir la possibilité pour un élève de s’inscrire (et se desinscrire) facilement à une leçon.


création d'une méthode et route d'insciption dans **LeconController**, qui désinscrit un étudiant déjà incrit, et l'inscrit s'il ne l'est pas. le bouton s'inscrire est visible uniquement pour les personnes connectée, et s'adaptent à leur statut d'inscription.
le bouton est présent sur l'index des leçons et dans le show d'une leçon.

maintenant un nouvel incrit est eleve par défaut, ce qui servira pour la suite  
la fixture a été mise à jour pour créé également un élève  
seul un élève peut voir les boutons d'inscriptions  

### Correction d'une erreur dans le UserAuthenticator qui provoquait une erreur symfony si on tentait de se connecter à un compte non existant, due à des bouts de code oubliés, liés à une experimentation pour trouver un bug lors de la question 7


# Question 13 

Offrir la possibilité pour un professeur de voir la liste des élèves inscrits à une leçon et pour un élève de voir ses inscriptions.

création d'une table dans le show d'une leçon qui affiche à un professeur connecté la liste des élèves qui y sont inscrits

création d'une liste d'hyperlien sur la page par défaut (/ ou /accueil) pour l'élève qui redirigent vers les leçons auquelles il est incrit.

# Question 14 
Embellissez votre application et pensez, si cela n’est pas déjà fait, à modifier votre fixture.

La fixture inscrit automatiquement l'eleve initial à toutes les lecons


# Question 15   
Introduire le rôle administrateur pour les professeurs. Un professeur ayant en plus le rôle d’administrateur aura la possibilité d’ajouter et de supprimer des professeurs, ainsi que d’octroyer le rôle d’administrateur à un professeur.


sur la page d'accueil, un professeur avec le role admin voit tout les user non admin, et peut alterner le role ROLE_ELEVE et ROLE_PROFESSEUR à un non admin, et convertir un professeur en admin

# Question 16 
Revoir votre application pour que le site réservé aux professeurs et celui réservé au public soit clairement séparés en gérant correctement les droits d’accès aux pages. 

Les accès aux pages et routes ont été sécurisée au fur et à mesure des questions précédentes lors de la mise en place des restrictions demandées avec les Annotations IsGranted dans les controlleurs, et les boutons de navigation masqué si un utilisateur n'en a pas la permission, afin d'harmoniser les autorisation backend et ce que le frontend affiche 


# Question 16 
L'apparence de la page d'une leçon précise a été retouchée, pour l'affichage des élèves inscrits

La gestion des admin a été déplacée sur une page spécifique, et son apparence revue, et un lien navbar apparait quand on est un admin