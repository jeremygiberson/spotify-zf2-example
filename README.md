# Spotify Zf2 Example

This project is part of azPHP's user group series of projects where an example application is re-written in different frameworks.

It provides an example application written with Zend Framework 2.

## Previous Projects
  * Spotify Album Search written w/ Symfony https://github.com/azPHP/spotify-symfony-example
  * Spotify Album Search written w/ Laravel https://github.com/azPHP/spotify-laravel-example


# Setup
The following steps will spin up the application

  1. Clone this repository
  2. cd path/to/cloned/repository
  3. composer install
  4. php public/index.php migration apply album
  5. php -S 0.0.0.0:8080 -t public/ public/index.php
  6. visit `http://localhost:8080/album`