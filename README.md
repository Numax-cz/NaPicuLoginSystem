## NapicuLoginSystem
* NaPicuLoginSystem je login/register system v PHP.
* Kód není 100% bezpeční pouze ukazuje jak takový login/ register systém může vypadat. Proto nezaručuji bezpečnost!!
## Setup
* Pouze pro snadné nastavení
```sql
CREATE TABLE `LoginSystem`.`login` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(500) NOT NULL , `permission` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
* Poté nastavte v `config.php` údaje od databáze
* Většinu nastavení najdete v `db.php`
* Jestli změníte název tabulky, nebo jiné parametry v databázi budete je muset změnit v `db.php` 

```php
return [
    "Config" => [
        "DatabaseMain" => [
            "host" => "localhost",
            "user" => " ",
            "password" => " ",
            "name" => " "
        ],
    ]
]
```
