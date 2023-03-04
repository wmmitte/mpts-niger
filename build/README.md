
## A propos
Plateforme de demande de Visas

## Fonctionnalités
| Module | Fonctionnalités | Statut |
| ----------- | ----------- | ----------- |
| Authentification | Connexion | OK |
| Authentification | Déconnexion | OK |
| Authentification | Recupération mot de passe | OK |
| Parametrage | Gestion des localités | OK |
| Parametrage | Gestion des branches d'activités | OK |
| Parametrage | Gestion des rôles utilisateurs | OK |
| Parametrage | Gestion des utilisateurs | OK |
| Parametrage | Gestion des employeurs | OK |
| Demande | Dépot/saisie d'une demande | Adapting |
| Demande | Transmission récépissé de dépot | - |
| Demande | Demandes enregistrées |  OK |
| Demande | Mise à jour d'une demande | - |
| Demande | Annulation d'une demande | - |
| Demande | Suivi d'une demande d'une demande | - |
| Demande | Création «recours gracieux» pour les cas de visa rejeté  | - |
| Demande | Traitement et visibilité de la demande par niveau hierarchique  | - |
| Demande | cycle de traitement du dossier via les différents services concernés, pour validation et commentaires  | - |
| Demande | archivage et accessibilité des données par niveau hiérarchique  | - |
| Demande | Proposition de numériser les archives éventuellement de demande visa de travail  | - |
| Demande | transmission de la requête entre les deux entité de traitement (Ministère et ANPE)  | - |
| Statistique | Etats statistiques | - |
| Statistique | Telechargement des états statistiques aux format .pdf | - |
| Statistique | Telechargement des états statistiques aux format .xls | - |
| Statistique | Telechargement des états statistiques aux format .docx | - |
| Statistique | Tableau de board statistiques | - |
| Notification | Alerte pastille, 3 mois à l'avance de la date d'expiration | - |
| Notification | Alerte mail, 3 mois à l'avance de la date d'expiration | - |
| API | API facturation | - |

## Regles de gestion
- un travailleur peut être un national ou un etranger
- un national peut faire la demande d'enregistrement de son contrat 
de travaail à travers son employeur. Il peut également renouveler son
enregistrement dans le cas ou il a un nouveau contrat (chez l'ancien
employeur ou un nouveau employeur)
- un etranger lui demande un visa et l'enregistrement de son contrat 
de travail. Il peut également renouveller son visa mis aussi son
 contrat de travail
- le nombre de renouvellement est limité
- une demande contient des pieces jointes
- une demande a un statut qui evolue au fil du temps ( à vérifier) :
  + Nouvelle 
  + Rejetee  
  + Recue 
  + Satisfaite etc 
- une demande peut etre rejetee avec un motif
- une demande rejetée peut faire l'objet d'un recours. Dans ce cas, une demande accompagne le dossier qui est identique aux éléments du dossier initial
- un employé peut avoir plusieurs contrat (à vérifier) avec un seul 
contrat en cours avec le même employeur
- une demande concerne un domaine de qualification et une branche d'activite donné
- une branche peut avoir plusieurs domaines de qualification.
- une domaine de qualification peut appartenir à plusieurs branches
  + exemple de branche d''activité' : transformation et communication
  + exemple de domaine de qualification : informatique

## Entités & définitions
- un employeur est défini par :
  + sa raison sociale
  + la nature de ses activités
  + sa boite postal
  + son telephone 1, telephone 2
  + sa localité
  + son quartier
  + email de contact
  + site web
  + son état dans la BD (actif ou inactif.)
    + actif : peut  être utilisé pour de nouvelles demandes
    + inactif : utilisable que dans les états ou les stats
- un travailleur ou employe est défini par : 
  + son nom, prenom
  + date de naissance
  + résidence habituelle
  + nationnalité
  + son sexe
  + situation de famille
  + profession
  + sa boite postal
  + son telephone 1, telephone 2
  + son quartier
  + email de contact
  + autres infos
- un contrat est défini par : 
  + l'employeur
  + le travailleur
  + la duree du contrat
  + la localite(region) dexercement du contrat
  + le type de contrat (CDI / CDD)
  + la date de début/fin
  + le salaire
- users
  + nom
  + prenom
  + sexe
  + email
  + password
  + avatar
  + role (admin (tous les droits), agent (enregistrement et etats statiques), superviseur (consulte tout sans modifier)) //(responsable, secretaire, directeur, agent, admin)
	#entites

- entites
  + libelle
  + restreindre
  + #entite

- employeurs
  + nom
  + prenom
  + sexe
  + telephone
  + email
  + #localite(nationalite)

- activite
  + libelle
  + description
  + type (branche | secteur)

- contrat
  + numero_visa
  + date_expiration

- demandes
  + type (Nouvelle | renouvellement)
  + nom_entreprise
  + profession
  + #contrat
  + #emploiyeur
	#branche_activite
	#secteur_activite
	#entite (en charge)
	#user (en charge)

- pieces_joints
  + type
  + url
  + #demande


### Partenaires

- **[Emerzone](https://www.emerzone.com/)**
- **[SOTEC Co.](https://www.songo-technologies.com)**

## Contributeurs

- AMG
- SC
- WMY
- CE
- B
- TJ

## License

[MIT license](https://opensource.org/licenses/MIT).

find . -name .DS_Store -print0 | xargs -0 git rm -f --ignore-unmatch
git commit -m '.DS_Store supprimé!'

# COMMANDES
1 - +++++++++
// php artisan make:migration alter_table_[table_name]_change_[column_name] --table=[table_name]
php artisan make:migration alter_table_contracts_change_salaire --table=contracts
$table->float('salaire', 10, 0)->change();
---

