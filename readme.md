# ASSAD V2 - Zoo Virtuel pour la CAN 2025 🦁

## À Propos du Projet

**ASSAD** est un zoo virtuel développé à l'occasion de la Coupe d'Afrique des Nations 2025 organisée au Maroc. Le projet vise à promouvoir les lions de l'Atlas et les animaux africains auprès des supporters et visiteurs du continent.

Cette application web dynamique est développée en **PHP orienté objet (POO)** avec **PDO** pour la gestion de la base de données, représentant une refonte complète de la version précédente réalisée en PHP procédural.

## 🎯 Fonctionnalités Principales

### Pour les Visiteurs
- ✅ Inscription et connexion sécurisées avec validation
- ✅ Consultation de la liste des animaux avec filtres (habitat, pays)
- ✅ Page spéciale dédiée à **Asaad - Lion de l'Atlas**
- ✅ Navigation des visites guidées disponibles avec recherche et filtres
- ✅ Réservation de visites guidées (nombre de personnes)
- ✅ Ajout de commentaires et notes sur les visites effectuées
- ✅ Suivi des capacités restantes en temps réel

### Pour les Guides
- ✅ Création et gestion de visites guidées (titre, description, date, heure, durée, prix, langue, capacité)
- ✅ Ajout d'étapes multiples pour créer des parcours complets
- ✅ Consultation des réservations avec nombre de personnes
- ✅ Annulation de visites
- ✅ Statistiques personnelles (visites du mois, visiteurs, notation moyenne)

### Pour les Administrateurs
- ✅ Gestion complète des utilisateurs (activation, désactivation, approbation des guides)
- ✅ CRUD complet pour les animaux (avec images et habitats)
- ✅ CRUD complet pour les habitats
- ✅ Statistiques détaillées :
  - Nombre total de visiteurs et utilisateurs
  - Nombre total d'animaux
  - **Animaux les plus consultés** (par nombre de vues)
  - **Visites guidées les plus réservées** (par nombre de réservations)
  - Revenus de la billetterie
- ✅ Approbation des comptes guides en attente

## 🏗️ Architecture Technique

### Structure Orientée Objet

```
Classes/
├── db.php              # Connexion PDO singleton
├── User.php            # Classe de base utilisateur
├── Admin.php           # Hérite de User
├── Guide.php           # Hérite de User
├── Visitor.php         # Hérite de User
├── Animal.php          # Gestion des animaux
├── Habitat.php         # Gestion des habitats
├── Tour.php            # Gestion des visites guidées
├── TourStep.php        # Étapes des visites
├── Reservation.php     # Réservations
└── Commentaire.php     # Commentaires et notes
```

### Base de Données

#### Tables Principales
- **users** : Utilisateurs avec rôles (admin, guide, visitor)
- **animal** : Animaux avec tracking des vues
- **habitat** : Habitats avec climat et zones
- **tours** : Visites guidées avec capacité
- **tour_step** : Étapes des visites (parcours)
- **reservation** : Réservations avec nombre de personnes
- **comments** : Commentaires et notes (1-5)

### Sécurité Implémentée

- ✅ **Validation serveur avec regex** : Email, nom, mot de passe
- ✅ **Hachage des mots de passe** : bcrypt via `password_hash()`
- ✅ **Sanitisation des entrées** : `htmlspecialchars()` sur toutes les entrées utilisateur
- ✅ **Requêtes préparées PDO** : Protection contre les injections SQL
- ✅ **Validation du rôle** : Vérification stricte des rôles autorisés
- ✅ **Sessions sécurisées** : Gestion des sessions pour l'authentification

### Validation des Données

#### Email
- Format valide : `user@domain.com`
- Regex : `/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/`

#### Nom
- Lettres uniquement (avec accents)
- 2-50 caractères
- Regex : `/^[a-zA-ZÀ-ÿ\s\-]{2,50}$/u`

#### Mot de passe
- Minimum 8 caractères
- 1 majuscule, 1 minuscule, 1 chiffre
- Regex : `/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/`

## 📁 Structure du Projet

```
ASSAD-V2/
├── Classes/              # Classes PHP OOP
├── Modelisation/         # Diagrammes UML (Use Case, Class, ERD)
├── includes/
│   ├── admin/           # Actions admin
│   ├── auth/            # Authentification
│   ├── guide/           # Actions guide
│   └── visitor/         # Actions visiteur
├── pages/
│   ├── admin/           # Pages administrateur
│   ├── guide/           # Pages guide
│   ├── animals.php      # Liste des animaux
│   ├── asaad.php        # Page Lion de l'Atlas
│   ├── tours.php        # Liste des visites
│   └── tour_details.php # Détails d'une visite
├── sql/
│   └── install.sql      # Script d'installation DB
├── index.php            # Page d'accueil
├── login.php            # Page de connexion
├── register.php         # Page d'inscription
└── readme.md            # Documentation
```

## 🚀 Installation

### Prérequis
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache/Nginx)
- XAMPP, WAMP, ou similaire

### Étapes d'installation

1. **Cloner le repository**
   ```bash
   git clone https://github.com/ilyas-doughmi/ASSAD-V2.git
   cd ASSAD-V2
   ```

2. **Configurer la base de données**
   - Importer le fichier `sql/install.sql` dans phpMyAdmin ou MySQL
   - La base de données `ASSAD` sera créée automatiquement
   - Un compte admin par défaut sera créé :
     - Email : `admin@gmail.com`
     - Mot de passe : `admin123`

3. **Configurer la connexion**
   - Ouvrir `Classes/db.php`
   - Modifier les paramètres si nécessaire :
     ```php
     private $host = "localhost";
     private $username = "root";
     private $password = "";
     private $db_name = "assad";
     ```

4. **Démarrer le serveur**
   - Démarrer Apache et MySQL via XAMPP/WAMP
   - Accéder à l'application : `http://localhost/ASSAD-V2/`

## 🎨 Technologies Utilisées

- **Backend** : PHP 7.4+ (POO)
- **Base de données** : MySQL avec PDO
- **Frontend** : 
  - HTML5
  - TailwindCSS 3 (via CDN)
  - JavaScript ES6+
  - Font Awesome 6
- **Fonts** : Cinzel (serif), Outfit (sans-serif)

## 📊 Diagrammes UML

Le projet inclut trois diagrammes dans le dossier `Modelisation/` :
- **Cas d'utilisation** : Interactions principales du système
- **Diagramme de classes** : Structure OOP complète
- **ERD** : Relations de la base de données

## 👥 Rôles et Permissions

| Fonctionnalité | Visiteur | Guide | Admin |
|----------------|----------|-------|-------|
| Voir les animaux | ✅ | ✅ | ✅ |
| Réserver une visite | ✅ | ✅ | ❌ |
| Créer une visite | ❌ | ✅ | ❌ |
| Gérer les animaux | ❌ | ❌ | ✅ |
| Gérer les utilisateurs | ❌ | ❌ | ✅ |
| Voir les statistiques | ❌ | Limitées | Complètes |

## 🔐 Comptes par Défaut

### Administrateur
- Email : `admin@gmail.com`
- Mot de passe : `admin123`

> **Note** : Les comptes guides doivent être approuvés par l'administrateur avant d'être actifs.

## 📝 User Stories Implémentées

### Fonctionnelles
- ✅ Inscription et connexion avec rôles (Visiteur, Guide)
- ✅ Gestion des utilisateurs par l'admin (activation, approbation guides)
- ✅ Création et gestion de visites guidées par les guides
- ✅ Ajout d'étapes multiples aux visites
- ✅ Consultation des réservations par les guides
- ✅ Page spéciale "Asaad - Lion de l'Atlas"
- ✅ Liste et filtrage des animaux
- ✅ Consultation et réservation de visites guidées
- ✅ Commentaires et notes sur les visites
- ✅ Recherche de visites guidées
- ✅ CRUD complet pour animaux et habitats
- ✅ Statistiques détaillées pour l'admin

### Techniques
- ✅ Diagramme de cas d'utilisation UML
- ✅ Diagramme de classes UML détaillé
- ✅ Utilisation de PDO pour toutes les requêtes
- ✅ Classes dédiées avec attributs et méthodes CRUD
- ✅ Relations entre classes (héritage, associations)
- ✅ Validation serveur avec Regex

## 🎯 Améliorations Futures

- [ ] Interface d'édition de visites pour les guides
- [ ] Interface d'édition d'habitats pour l'admin
- [ ] Statistiques des visiteurs par pays
- [ ] Protection CSRF
- [ ] Rate limiting sur l'authentification
- [ ] Système de logs
- [ ] Mode sombre/clair

## 📄 Licence

Ce projet est développé dans un cadre pédagogique pour la formation **Développeur Web et Web Mobile**.

## 👨‍💻 Auteur

**Ilyas Doughmi**
- GitHub : [@ilyas-doughmi](https://github.com/ilyas-doughmi)

---

**CAN 2025 - Maroc 🇲🇦**
