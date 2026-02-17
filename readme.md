# 🚀 Torpedux Store - E-Commerce PHP

Bienvenue sur **Torpedux Store**, une application e-commerce robuste développée en PHP natif pour mon projet de fin d'études.

## 📋 Fonctionnalités clés

### 🛒 Expérience Client
- **Accueil Dynamique** : Affichage automatique des 3 derniers produits ajoutés à la base de données.
- **Catalogue de Services** : Liste complète des articles avec système de mise en page responsive.
- **Fiches Produits** : Détails complets incluant le prix formaté, la description et la gestion du stock disponible.
- **Gestion du Panier** : Ajout d'articles, suppression dynamique et calcul du total en temps réel via les sessions PHP.

### 🛠️ Administration (Back-Office)
- **Gestion du Catalogue** : Interface complète pour ajouter, modifier ou supprimer des produits.
- **Upload d'Images** : Système d'enregistrement automatique des visuels dans le dossier `assets/images/`.
- **Historique des Commandes** : Suivi des ventes avec affichage sécurisé des coordonnées clients et des montants.
- **Navigation Sécurisée** : Gestion des erreurs et messages d'alerte personnalisés pour une navigation admin fluide.

## 🛠️ Installation et Configuration

1. **Environnement** : Utilisation de XAMPP avec PHP 8.x.
2. **Base de données** :
   - Créer une base de données MySQL.
   - Importer le fichier SQL fourni via phpMyAdmin.
   - Configurer les accès dans `includes/db.php`.
3. **Structure des fichiers** : 
   - S'assurer que le dossier `public/assets/images/` possède les droits d'écriture pour l'upload des photos.

## 🔒 Sécurité
- **Protection XSS** : Utilisation systématique de `htmlspecialchars()` sur toutes les sorties de données.
- **Injections SQL** : Toutes les requêtes sont préparées via PDO (ex: `prepare()` et `execute()`).
- **Validation** : Vérification de l'existence des données avant affichage pour éviter les "Fatal Errors".

## 💻 Technologies
- PHP Natif (Architecture incluant des templates réutilisables)
- SQL (MySQL / PDO)
- Bootstrap 5 & CSS3