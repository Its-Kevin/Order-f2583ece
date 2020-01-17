<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>
    <a href="index.php">Terug</a>
    <?php
    $host = '127.0.0.1';
    $db   = 'netland';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    $query = 'SELECT * FROM films WHERE id =' . $_GET['id'];
    $result = $pdo->query($query)->fetch();
    ?>
    <table>
        <tbody>
            <tr>
                <td><strong>Datum van uitkomst</strong></td>
                <td><?php echo $result['date'] ?></td>
            </tr>
        </tbody>
    </table>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $result['yt_id'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

</html>