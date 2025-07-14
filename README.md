
# 🛍️ Joudour – Boutique en ligne Symfony 6

**Joudour** est une boutique en ligne moderne développée avec **Symfony 6** par **Mechri Maroua**.  
Ce projet intègre une architecture complète avec Docker, Stripe et une gestion avancée des utilisateurs.

---

## 🚀 Fonctionnalités

| Catégorie               | Détails                                                                 |
|-------------------------|-------------------------------------------------------------------------|
| **🔐 Authentification**  | Inscription, connexion, vérification email, réinitialisation mot de passe |
| **🛒 E-commerce**       | Catalogue produits, panier, paiement Stripe sécurisé                    |
| **⚙️ Administration**  | Backoffice de gestion                                                   |
| **📦 Infrastructure**   | Dockerisé avec MySQL, Mailhog (tests emails)                            |

---

## 🛠 Stack Technique

### Backend
- PHP 8.0+ • Symfony 6 • Doctrine ORM
- Bundles : `ResetPassword`, `VerifyEmail` (SymfonyCasts)

### Frontend
- Twig • Webpack Encore • Bootstrap • CKEditor

### Services
- Stripe (paiements) • Mailhog (développement) • Docker Compose

---

## ⚙️ Installation

### Prérequis
- Docker et Docker Compose
- Node.js ≥ 14

### 1. Configuration initiale
```bash
git clone https://github.com/marouamechri/joudour.git
cd joudour
cp .env .env.local  # Puis éditer avec vos paramètres

### 2. Variables d'environnement (.env.local)
ini
DATABASE_URL="mysql://root:root@db:3306/joudour?serverVersion=8.0"
STRIPE_SECRET_KEY="votre_clé_test"
MAILER_DSN="smtp://mailhog:1025"
### 3. Lancement des containers
```bash
docker-compose up -d --build
### 4. Installation des dépendances
```bash
docker exec -it php bash
composer install
npm install && npm run dev
exit

### 5. Base de données
```bash
docker exec -it php bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load  # Si vous avez des fixtures

## 🔐 Accès de test

Rôle	Email	Mot de passe
Administrateur	admin@gmail.com	adminadmin
Client	user@gmail.com	useruser

## 📂 Structure du projet

text
joudour/
├── assets/          # Frontend (JS/SCSS)
├── config/          # Configuration Symfony
├── docker/          # Configs Docker
├── public/          # Fichiers publics
├── src/
│   ├── Controller/  # Contrôleurs
│   ├── Entity/      # Entités Doctrine
│   └── ...          # Services, etc.
├── templates/       # Vues Twig
├── .env             # Configuration
└── docker-compose.yml

##👩‍💻 Auteur

Mechri Maroua
Développeuse Full-Stack Symfony/JavaScript
📧 marouamechri@gmail.com
🔗 GitHub (@marouamechri)

##📌 Roadmap

Mise en place de l'architecture de base

Intégration de Stripe

Amélioration de l'UI/UX

Ajout de tests fonctionnels



