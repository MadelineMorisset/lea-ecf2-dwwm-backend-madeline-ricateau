# 1 Position du problème
						
Vous devez réaliser le site d’un outil de stockage et de partage de liens web (links).

Ce site permet également de commenter les liens.

Le contenu est mis à jour par l’administrateur du site.

      
# 2 Spécification fonctionnelle
						
Il y a 2 types d’utilisateurs :

- Visiteur : il a accès à la page d’accueil qui contient les liens.
  - Ceux-ci contiennent le lien, un titre, une description, une date. Il peut commenter les liens publiés.
- Administrateur : il peut ajouter / modifier / supprimer des liens.
  - Il peut se connecter, se déconnecter (pas de modification de mot de passe dans ce TP).

Attention à bien valider le contenu des formulaires (côté javascript et PHP)


## NB :  
Il n’y a pas de pagination sur aucune page

Pas besoin d’être connecté pour publier

On considère que la date est enregistrée à la publication. Elle n’est pas modifiable.


## Navigation
Le menu permet de se connecter.

Une fois connecté, le menu contient un lien vers l’admin / , une possibilité de déconnexion

Chaque lien est cliquable pour accéder aux commentaires. Et sous chaque Page commentaire, on peut ajouter un commentaire.

			
# 3 Informations complémentaires
Police à utiliser : Raleway

Votre base de données contiendra :
- Une table User : id_user (clé primaire), login, password. Cette table ne sert qu’à stocker les informations de l’administrateur.
- Une table Link : id_link (clé primaire), url, titre, description, date
- Une table Link_Comment : id_comment (clé primaire), id_link (clé étrangère), login, commentaire, date, heure
