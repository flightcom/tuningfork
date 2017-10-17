Application Tuningfork

# Installation

```
$ dssh $(did1)

$ php composer.phar self-update
$ php composer.phar install
```

```
$ sudo npm install && bower install
$ gulp
```

- Create file `migrations-db.php` :

```
<?php

return [
    'dbname'   => 'tuningfork',
    'user'     => 'root',
    'password' => 'root',
    'host'     => 'localhost',
    'driver'   => 'mysqli'
];
```
