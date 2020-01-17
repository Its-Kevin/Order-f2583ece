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

    $query = 'SELECT * FROM series WHERE id =' . $_GET['id'];
    $result = $pdo->query($query)->fetch();
    ?>
    <h1><?php echo $result['title'] ?> - <?php echo $result['rating'] ?></h1>
    <table>
        <tbody>
            <tr>
                <td><strong>Awards?</strong></td>
                <td><?php
                    if ($result['has_won_awards']) {
                        echo 'Ja';
                    } else {
                        echo 'Nee';
                    }
                    ?></td>
            </tr>
            <tr>
                <td><strong>Seasons</strong></td>
                <td><?php echo $result['seasons'] ?></td>
            </tr>
            <tr>
                <td><strong>Country</strong></td>
                <td><?php echo $result['country'] ?></td>
            </tr>
            <tr>
                <td><strong>Language</strong></td>
                <td><?php echo $result['language'] ?></td>
            </tr>
        </tbody>
    </table>
    <p><?php echo $result['description'] ?></p>
</body>

</html>