# Documentation d’installation du projet

```
git clone https://github.com/tbatozki/classroom-grades-test.git
cd classroom-grades-test
cd classroom_grades_project
composer install

php bin/console doctrine:database:create
php bin/console doctrine:fixtures:load
```

# Documentation concernant l’exercice à réaliser

Pour interroger l’API, plusieurs méthodes sont possibles :
* Sandbox d'API Platform disponible dans la doc de l’api à l’url suivante : [domain_url]/api
* Postman

## Consignes

Exercice : créer une API de notation d'élèves en Symfony

Un élève est caractérisé par :
* Un nom
* Un prénom
* Une date de naissance

Une note est caractérisée par :
* Une valeur : entre 0 et 20
* Une matière : Champ texte

L'API devra permettre de :
* Ajouter un élève
* Modifier les informations d'un élève (nom, prénom, date de naissance)
* Supprimer un élève
* Ajouter une note à un élève
* Récupérer la moyenne de toutes les notes d'un élève
* Récupérer la moyenne générale de la classe (moyenne de toutes les notes données)

Une attention particulière sera donnée aux respects des bonnes pratiques de code et de construction des API. Aussi, veuillez nous fournir une documentation précise pour l'utilisation de votre API.
Merci et bon test !

### Ajouter un élève

Exemple de query si l'on souhaite ajouter un élève

method: POST
route: /api/students
body :
```json
    {
      "name": "Dunom",
      "firstname": "Anna",
      "birthdate": "2006-07-28",
      "schoolClass": "/api/school_classes/2"
    }
```

### Modifier les informations d'un élève (nom, prénom, date de naissance)

* Exemple de query si l’on souhaite changer plusieurs attributs
de l'élève (MAJ complète de l'objet)

method: PUT
route : /api/students/3
body:
```json
    {
      "name": "Dumont",
      "firstname": "Anna",
      "birthdate": "2006-01-24",
      "schoolClass": "/api/school_classes/2",
      "grades": []
    }
```

* Exemple de query si l’on souhaite ne changer que le nom de l'élève

method: PATCH
route : /api/students/3
body :
```json
    {
      "name": "Dunond",
    }
```

### Supprimer un élève

Exemple de query si l'on souhaite supprimer un élève

method: DELETE
route : /api/students/1

### Ajouter une note à un élève

Exemple de query si l'on souhaite ajouter une note à un élève

method: POST
route : /api/grades
body :
```json
    {
      "value": "15.5",
      "subject": "Maths",
      "student": "/api/students/2"
    }
```

### Récupérer la moyenne de toutes les notes d’un élève

Exemple :

method: GET
route : /api/students/2/average

### [OPTIONNEL] Récupérer la moyenne de toutes les notes d’un élève dans une matière donnée

Exemple :

method: GET
route : /api/students/2/average/anglais

### Récupérer la moyenne générale de la classe

Exemple :

method: GET
route : /api/school_classes/2/average

### [OPTIONNEL] Récupérer la moyenne de la classe pour une matière donnée

Exemple :

method: GET
route: /api/school_classes/2/average/anglais

### [OPTIONNEL] Récupérer la moyenne générale de l’école

Exemple :

method: GET
route : /api/school_classes/average

### [OPTIONNEL] Récupérer la moyenne de l’école dans une matière donnée

Exemple :

method: GET
route : /api/school_classes/average/maths
