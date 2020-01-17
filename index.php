<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>
    <?php
    function select($quary)
    {
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

        $formatResult = array();

        $rawResult = $pdo->query($quary);
        while ($row = $rawResult->fetch()) {
            $rowResult = array();

            foreach ($row as $collum => $value) {
                $rowResult[$collum] = $value;
            }

            $formatResult[] = $rowResult;
        }

        return $formatResult;
    }
    ?>
    <h1>Welkom op het netland beheerders paneel</h1>

    <h3>Series</h3>

    <table>
        <thead>
            <th><a href="index.php?sort='title'&<?php if (isset($_GET['sortM'])) {
                                                    echo 'sortM=' . $_GET['sortM'];
                                                } ?>">Titel</a></th>
            <th><a href="index.php?sort='rating'&<?php if (isset($_GET['sortM'])) {
                                                        echo 'sortM=' . $_GET['sortM'];
                                                    } ?>">Rating</a></th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $rows = null;

            if (isset($_GET['sort'])) {
                if ($_GET['sort'] == "'title'") {
                    $rows = select('SELECT * FROM series ORDER BY title ASC');
                } elseif ($_GET['sort'] == "'rating'") {
                    $rows = select('SELECT * FROM series ORDER BY rating ASC');
                }
            } else {
                $rows = select('SELECT * FROM series');
            }

            foreach ($rows as $row) {
                echo <<<EOT
                        <tr>
                            <td>${row['title']}</td>
                            <td>${row['rating']}</td>
                            <td><a href="series.php?id=${row['id']}">Meer info</a></td>
                        </tr>
                    EOT;
            }
            ?>
        </tbody>
    </table>


    <h3>Films</h3>

    <table>
        <thead>
            <th><a href="index.php?sortM='title'&<?php if (isset($_GET['sort'])) {
                                                        echo 'sort=' . $_GET['sort'];
                                                    } ?>">Titel</a></th>
            <th><a href="index.php?sortM='duration'&<?php if (isset($_GET['sort'])) {
                                                        echo 'sort=' . $_GET['sort'];
                                                    } ?>">Duur</a></th>
            <th></th>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['sortM'])) {
                if ($_GET['sortM'] === "'title'") {
                    $rows = select('SELECT * FROM films ORDER BY title ASC');
                } elseif ($_GET['sortM'] === "'duration'") {
                    $rows = select('SELECT * FROM films ORDER BY duur ASC');
                }
            } else {
                $rows = select('SELECT * FROM films');
            }
            foreach ($rows as $row) {
                echo <<<EOT
                            <tr>
                                <td>${row['title']}</td>
                                <td>${row['duur']}</td>
                                <td><a href="films.php?id=${row['id']}">Meer info</a></td>
                            </tr>
                        EOT;
            }
            ?>
        </tbody>
    </table>
</body>

</html>