# the Elephant in the room
'the Elephant in the room' is my private PHP flame work.


## 1. directory
### ■ pages
### ■ page/layouts
### ■ classes
- The classes directory can contain files for Model classes for DB operations and validation classes for each page.

### ■ database
### ■ fragile
### ■ asset
### ■ config
### ■ errors
### ■ interface
### ■ util
- trait

### ■ php unit
- install it using Composer.
- vendor/bin/phpunit tests/xxxxxx.php


## 2. php.ini

### ■ including_path
- Set include_path to the path to the project directory in the ini file.
For example, if you are using XAMPP, set up the following
```php
;include_path=C:\xampp\php\PEAR
include_path=C:\xampp\htdocs\the-elephant-in-the-room
```

## 3. architecture
- 1. Pages(UI)
- 2. Logics(Bussiness Logic)
- 3. Class(Model)