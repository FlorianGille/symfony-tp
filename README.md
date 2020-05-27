# Symfony TP

### Start the project

Clone the project

```
git clone https://github.com/FlorianGille/symfony-tp.git
```

First, install dependencies

```bash
composer install
```

```bash
composer update
```

Then, update your database

```bash
php bin/console make:migration
```

```bash
php bin/console doctrine:migrations:migrate
```
