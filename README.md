# NoteSpace

> Your space to think, write, and stay organized.

A simple note-taking web app built with CodeIgniter 4. Supports categories, pinning, archiving, and trash management.

## Tech Stack

- **PHP** 8.2+
- **CodeIgniter** 4.7
- **MySQL** (or compatible)
- **Composer**

## Features

- Auth: register, login, logout
- Notes: create, edit, delete, pin
- Organize: categories, archive, trash, restore
- Empty trash

## Setup

```bash
git clone https://github.com/ibnumardini/NoteSpace.git
cd notespace
composer install
cp env .env
```

Edit `.env`:

```ini
database.default.hostname = localhost
database.default.database = notespace
database.default.username = root
database.default.password =
```

Run migrations:

```bash
php spark migrate
```

Run seeders:

```bash
php spark db:seed User
php spark db:seed Category
php spark db:seed Note
```

Serve:

```bash
php spark serve
```

Visit `http://localhost:8080`.

## License

Apache 2.0 · Copyright 2026 Muhammad Fatkurozi
