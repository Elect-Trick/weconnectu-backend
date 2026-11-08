# Details API

This project exposes a JSON endpoint for adding a user's name, email, phone number, and message.

## Database setup

Create the `weconnectu` database and then create the table from the project root:

```sql
CREATE DATABASE IF NOT EXISTS weconnectu;
```

```sh
mysql -u root weconnectu < schema.sql
```

The endpoint defaults to a local MySQL server with the `root` user and no password. Configure a different connection using `DB_HOST`, `DB_USER`, `DB_PASS`, and `DB_NAME` environment variables.

## Run

The endpoint requires PHP with the MySQLi extension and a running MySQL server:

```sh
php -S 127.0.0.1:8000
```

Send a `POST` request to `http://127.0.0.1:8000/index.php` with a JSON body:

```sh
curl -X POST http://127.0.0.1:8000/index.php \
  -H 'Content-Type: application/json' \
  -d '{"name":"Ada Lovelace","email":"ada@example.com","phone":"+1-555-0100","message":"Please contact me."}'
```

A successful insert returns HTTP `201` with the inserted row's `id`. Invalid JSON returns `400`, invalid fields return `422`, unsupported methods return `405`, and database errors return `500`.

## Integration test

Start the server with a configured database and run:

```sh
php tests/endpoint_test.php
```

The test uses `API_BASE_URL` when set; otherwise it targets `http://127.0.0.1:8000/index.php`.