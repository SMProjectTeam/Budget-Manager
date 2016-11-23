# Budget Manager

[![Build Status](https://travis-ci.com/Saibamen/Budget-Manager.svg?token=aGxL6XsgiKL8Ss4SGZve&branch=master)](https://travis-ci.com/Saibamen/Budget-Manager)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

## Technologie i biblioteki

- PHP
- MySQL
- Laravel 5.3
- JavaScript
- AJAX
- JSON
- Highcharts
- Travis CI
- Bootstrap
- Font Awesome

## Wymagania

- PHP >= 7.0.12 (na niektórych serwerach localhost może nawet wystarczyć 5.6.21 lub nowsza)
- MySQL >= 5.5.X
- Najnowsza wersja [Composera](https://getcomposer.org/) - aktualizacja komendą `composer selfupdate`
- Następujące rozszerzenia włączone na serwerze PHP:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML

## Instalacja - localhost

1. Wypakuj całą zawartość do osobnego folderu w htdocs
2. Zmień nazwę pliku `.env.example` na `.env` oraz zmień w nim `APP_URL`, połączenie do bazy danych oraz maila
3. Utwórz poniższe foldery:

   ```
   mkdir bootstrap/cache
   mkdir storage
   mkdir storage/app
   mkdir storage/framework
   mkdir storage/framework/sessions
   mkdir storage/framework/cache
   mkdir storage/framework/views
   mkdir storage/logs
   ```
4. Wykonaj następujące polecenia:

  ```
  composer install --no-interaction
  php artisan key:generate
  php artisan migrate
  php artisan db:seed
  ```
5. Uruchom serwer poleceniem `php artisan serve`
6. Aplikacja dostępna jest już pod adresem [http://localhost:8000](http://localhost:8000)

## Instalacja - własny serwer

1. Wypakuj zawartość folderu `public` na serwer FTP
2. Resztę folderów dla bezpieczeństwa umieść w osobnym folderze poza `public_html` (lub `htaccess`)
3. W `index.php` z folderu `public` zamień obie ścieżki tak, aby znajdywały główny folder z kroku 2
4. Zmień nazwę pliku `.env.example` na `.env` oraz zmień w nim `APP_URL`, połączenie do bazy danych oraz maila
5. Ustaw chmody oraz utwórz poniższe foldery:

  ```
  mkdir bootstrap/cache
  mkdir storage
  mkdir storage/app
  mkdir storage/framework
  mkdir storage/framework/sessions
  mkdir storage/framework/cache
  mkdir storage/framework/views
  mkdir storage/logs
  chmod -R 777 bootstrap/cache
  chmod -R 777 storage
  ```
6. Wykonaj następujące polecenia:

  ```
  composer install --no-interaction
  php artisan key:generate
  php artisan migrate
  php artisan db:seed
  ```
Uwaga! Na niektórych hostingach polecenia z kroku 6 mogą nie wykonywać się poprawnie! Należy wtedy skorzystać z pomocy hostingodawcy.

## Funkcje

- [x] Logowanie do systemu
- [x] Wylogowanie z systemu
- [x] Resetowanie hasła
- [x] CRUD źródeł przychodów i wydatków
- [x] Seeder źródeł przychodów i wydatków
- [x] CRUD przychodów i wydatków
- [x] Seeder przychodów i wydatków
- [x] Uzupełnienie przychodów i wydatków ze źródeł przez AJAXa
- [ ] Wykres podsumowujący zsumowane przychody i wydatki względem dni, tygodni lub miesięcy
- [x] Wykresy podsumowujące procentowe udziały źródeł przychodów i wydatków
- [x] Wykres podsumowujący wydatki z podziałem na użytkowników
- [x] Wykres podsumowujący oszczędności, czyli różnicę między przychodami i wydatkami w obrębie miesiąca
- [x] Obsługa tłumaczeń

## Demo: [budgetmanager.it-maniak.pl](http://budgetmanager.it-maniak.pl/)

Użytkownik Tomek:<br />
   Login: test@test.pl<br />
   Hasło: test

Użytkownik Kasia:<br />
   Login: user@test.pl<br />
   Hasło: kasia123

## O autorze

Adam "Saibamen" Stachowicz<br />
Państwowa Wyższa Szkoła Zawodowa im. Witelona w Legnicy<br />
III rok Informatyki spec. Systemy i Sieci Komputerowe

Programista od 14 roku życia, głównie webdev (PHP).<br />
W wolnych chwilach rowerzysta, DJ oraz fotograf.
