# Setup

Installez les dépendances

```bash
composer install
```

Copiez le fichier `.env` en `.env.local` et modifier la valeur de `DATABASE_URL` avec vos paramètres

Créez la BDD et le schéma

```bash
php bin/console doctrine:dabatase:create
php bin/console doctrine:migration:migrate
```

Lancez votre serveur web (j'utilise Symfony CLI ici)

```bash
symfony server:start
```

