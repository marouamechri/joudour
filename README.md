
# Joudour – Boutique en ligne

**Joudour** est une boutique en ligne développée avec Symfony 6 par Mechri Maroua. Ce projet met en œuvre une architecture moderne avec Docker, Webpack Encore, CKEditor, Stripe, et une base de données relationnelle via Doctrine ORM.

## 🚀 Fonctionnalités

- Gestion des utilisateurs et authentification
- Catalogue de produits
- Intégration du panier et des paiements via Stripe
- Interface d’administration
- Réinitialisation du mot de passe
- Vérification d’adresse e-mail

## 🛠️ Technologies utilisées

- PHP ≥ 8.0.2
- Symfony 6
- Doctrine ORM
- Twig
- Webpack Encore (JS/CSS)
- CKEditor
- Stripe PHP SDK
- Docker / Docker Compose
- SymfonyCasts Bundles (Reset Password, Verify Email)

## ⚙️ Installation du projet

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/votre-utilisateur/joudour.git
   cd joudour
Créer le fichier .env.local avec vos paramètres personnalisés (base de données, Stripe, mailer, etc.).

Démarrer l'environnement Docker :

bash
Copier
Modifier
docker-compose up -d --build
Installer les dépendances PHP et JS :

bash
Copier
Modifier
docker exec -it php bash
composer install
exit
npm install
npm run dev
Créer la base de données et les migrations :

bash
Copier
Modifier
docker exec -it php bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
Accéder à l’application :
Rendez-vous sur http://localhost dans votre navigateur.

🔐 Identifiants de test (exemple)
Rôle	Email	Mot de passe
Administrateur	admin@joudour.com	admin123
Utilisateur	user@joudour.com	user123

📦 Structure du projet
src/ : code source Symfony

templates/ : vues Twig

public/ : fichiers accessibles publiquement

assets/ : JS / SCSS gérés par Webpack

config/ : configuration Symfony

docker-compose.yml : environnement Docker

migrations/ : fichiers de migration Doctrine

🧑‍💻 Auteur
Développé par Mechri Maroua, développeuse full-stack passionnée par la création d'applications modernes.

📜 Licence
Ce projet est proposé à des fins d’apprentissage. Toute réutilisation est permise sous condition de mentionner l’autrice.

