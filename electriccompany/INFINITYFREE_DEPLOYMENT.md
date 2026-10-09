# InfinityFree deployment

This project uses CodeIgniter 4.7.4 and requires PHP 8.2 or newer. InfinityFree
free hosting currently uses PHP 8.3.

## Before uploading

1. Copy `.env.infinityfree.example` to `.env`.
2. Replace the domain and MySQL placeholders with the values shown in your
   InfinityFree control panel.
3. Keep `CI_ENVIRONMENT = production`.
4. Do not publish the completed `.env` file on GitHub.

## Upload and database

1. Extract the hosting ZIP and upload everything inside its `htdocs` folder
   into the hosting account's `htdocs` directory. Keep `.htaccess` files
   enabled in the FTP client.
2. In InfinityFree phpMyAdmin, select the database assigned to the account and
   import `electriccompany.sql`.
3. The SQL creates the required tables with no registered website users. Create
   the first user through the Register page.
4. Ensure `writable/cache`, `writable/logs`, and `writable/session` exist and are
   writable.

## Important

- InfinityFree database hostnames are not normally `localhost`. Use the exact
  MySQL hostname from the control panel.
- The root `.htaccess` sends requests to CodeIgniter's `public` directory, so
  the URL should not contain `/public`.
- If the site reports a database error, recheck all four database values in
  `.env`: hostname, database, username, and password.
- The SQL file is provided separately and is intentionally not stored inside
  the public hosting package.
