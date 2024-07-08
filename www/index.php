<?php

$DBuser = $_ENV['MYSQL_USER'];
$DBpass = $_ENV['MYSQL_ROOT_PASSWORD'];
$pdo = null;
$db_version = null;

try {
    $database = 'mysql:host=database:3306';
    $pdo = new PDO($database, $DBuser, $DBpass, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

    $db_version = $pdo->query('SELECT VERSION()')->fetchColumn();
} catch (PDOException $e) {
    // nothing
}

// Drop database connection
$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>

    <body>
        <h3>Welcome!</h3>
        <ul>
            <li>Apache version: <em><?= apache_get_version(); ?></em></li>
            <li>PHP: <em><?= phpversion(); ?></em></li>
            <li>
                <?php
                if ($db_version === null) {
                    echo "Failed to connect to database";
                } else {
                    echo "MySQL Version: $db_version";
                }
                ?>
            </li>
        </ul>

        <p>Quick links:</p>
        <ul>
            <li><a href="/phpinfo.php">phpinfo()</a></li>
            <li><a href="http://localhost:<? print $_ENV['PMA_PORT']; ?>">phpMyAdmin</a></li>
        </ul>

        <p>Secrets:</p>
        <ul>
            <li>MySQL User: <em><?= $DBuser ?></em></li>
            <li>MySQL Password: <em><?= $DBpass ?></em></li>
            <li>MySQL root password: <em><?= $_ENV['MYSQL_ROOT_PASSWORD'] ?></em></li>
            <li>MySQL database name: <em><?= $_ENV['MYSQL_DATABASE'] ?></em></li>
            <li>phpMyAdmin autologin password: <em><?= $_ENV['MYSQL_ROOT_PASSWORD'] ?></em></li>
        </ul>
    </body>

</html>