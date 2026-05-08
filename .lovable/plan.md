## Fix: PHP 7 compatibility for `str_starts_with()`

**Cause:** `str_starts_with()` is PHP 8.0+. The local XAMPP runs PHP 7.x, so `includes/resources.php:76` throws a fatal error.

**Fix:** Replace the two `str_starts_with()` usages with `strpos($p, '...') === 0`, which works on both PHP 7 and 8. No behavior change.

### Files to edit

- `includes/resources.php` — line 76 in `slf_resource_file_url()`:
  ```php
  if (strpos($p, 'assets/') === 0) return url($p);
  ```
- Grep the rest of the project for any other `str_starts_with` / `str_ends_with` / `str_contains` calls and replace them with PHP 7-safe equivalents (`strpos`, `substr`, `strpos !== false`).

### Optional hardening

Add a tiny polyfill block at the top of `includes/config.php` so any future use also works on PHP 7:
```php
if (!function_exists('str_starts_with')) {
    function str_starts_with($h, $n) { return $n === '' || strpos($h, $n) === 0; }
}
if (!function_exists('str_ends_with')) {
    function str_ends_with($h, $n) { return $n === '' || substr($h, -strlen($n)) === $n; }
}
if (!function_exists('str_contains')) {
    function str_contains($h, $n) { return $n === '' || strpos($h, $n) !== false; }
}
```
This single block future-proofs the whole codebase against the same error.

No DB or UI changes. Approve and I'll apply it in one pass.