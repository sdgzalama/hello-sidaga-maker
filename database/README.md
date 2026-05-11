# SLF Database

MySQL schema for the SustainLife Foundation website.

## Import

```bash
mysql -u root -p < database/schema.sql
```

This creates the `slf_site` database, all tables, and seeds the service catalogue
plus a default admin user.

## Default admin

- Username: `admin`
- Password: `admin`  *(change immediately)*

Generate a new bcrypt hash:

```bash
php -r "echo password_hash('your-new-password', PASSWORD_BCRYPT) . PHP_EOL;"
```

Then update the `password_hash` column of the `admins` row.

## Connecting from PHP

The connection settings live in `includes/config.php` (`DB_HOST`, `DB_NAME`,
`DB_USER`, `DB_PASS`). The PDO connection itself is in `includes/db.php` -
call `db()` to get the shared PDO handle.
