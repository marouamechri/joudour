
markdown
Copier
Modifier
# 🛍️ Joudour – Boutique en ligne

**Joudour** est une boutique en ligne développée avec **Symfony 6** par *Mechri Maroua*. Ce projet met en œuvre une architecture moderne basée sur **Docker**, **Webpack Encore**, **CKEditor**, **Stripe**, et une base de données relationnelle via **Doctrine ORM**.

---

## 🚀 Fonctionnalités principales

- 🔐 Authentification & gestion des utilisateurs
- 🛒 Catalogue de produits et panier d’achat
- 💳 Paiement sécurisé via Stripe
- ⚙️ Interface d’administration
- 📧 Vérification d’email
- 🔁 Réinitialisation de mot de passe

---

## 🛠️ Technologies utilisées

- PHP ≥ 8.0.2
- Symfony 6
- Doctrine ORM
- Twig
- Webpack Encore (JS/CSS)
- CKEditor
- Stripe PHP SDK
- Docker / Docker Compose
- SymfonyCasts Bundles (ResetPassword, VerifyEmail)

---

## ⚙️ Installation du projet

### 1. Cloner le dépôt

```bash
git clone https://github.com/marouamechri/joudour.git
cd joudour
2. Configurer l’environnement
Créer un fichier .env.local avec les paramètres personnalisés :

ini
Copier
Modifier
# Exemple de variables (à adapter)
DATABASE_URL="mysql://root:root@db:3306/joudour?serverVersion=8.0"
STRIPE_SECRET_KEY=sk_test_xxxxxxx
MAILER_DSN=smtp://mailhog:1025
3. Démarrer Docker
bash
Copier
Modifier
docker-compose up -d --build
4. Installer les dépendances PHP et JS
bash
Copier
Modifier
docker exec -it php bash
composer install
exit

npm install
npm run dev
5. Créer la base de données et exécuter les migrations
bash
Copier
Modifier
docker exec -it php bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
6. Initialiser les données
Le projet contient un fichier d’initiation avec des inserts SQL pour créer les utilisateurs de test et quelques produits :

bash
Copier
Modifier
php bin/console doctrine:database:import sql/joudour.sql
🔐 Identifiants de test
Rôle	Email	Mot de passe
Administrateur	admin@gmail.com	adminadmin
Utilisateur	user@gmail.com	useruser

📦 Structure du projet
bash
Copier
Modifier
joudour/
├── assets/               # JS / SCSS gérés par Webpack
├── config/               # Configuration Symfony
├── docker/               # Fichiers Docker personnalisés
├── migrations/           # Fichiers de migration Doctrine
├── public/               # Ressources accessibles publiquement
├── sql/joudour.sql       # Données d’initialisation (admin, user, etc.)
├── src/                  # Code source Symfony (contrôleurs, entités, services)
├── templates/            # Vues Twig
├── .env / .env.local     # Variables d’environnement
└── docker-compose.yml    # Configuration Docker Compose
👩‍💻 Auteur
Développé par Mechri Maroua, développeuse full-stack passionnée par la création d'applications modernes et utiles.

📧 Contact : marouamechri@gmail.com
🔗 GitHub : @marouamechri

✅ À faire
✅ Améliorer l’interface utilisateur

✅ Ajouter des tests fonctionnels
