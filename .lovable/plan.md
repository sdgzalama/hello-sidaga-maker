## Goal

Add a single PHP file at the repo root that prints `hello sidaga` when run locally with PHP. The existing React/TanStack app is left untouched. No preview will be attempted (Lovable does not run PHP).

## Changes

1. Create `index.php` at the repository root with the contents:

   ```php
   <?php
   echo "hello sidaga";
   ```

## How to run locally (after pulling)

From the repo root:

```
php -S localhost:8000 index.php
```

Then open `http://localhost:8000` to see `hello sidaga`.

## Notes

- No dependencies, no build step, no changes to the React app.
- The Lovable preview will continue to show the existing React app — the PHP file is only meaningful when you run it locally with a PHP runtime.