<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$errors = [];

/**
 * Traitement de formulaire en POST avec validation des champs
 */

if (!empty($_POST)) {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    if (empty($firstname)) {
        $errors[] = 'le champ firstname est obligatoire';
    }

    if (empty($lastname)) {
        $errors[] = 'le champ lastname est obligatoire';
    }


    if (empty($errors)) {

        $query = 'INSERT INTO friend (firstname, lastname) VALUES ("' . $firstname . '","' . $lastname . '")';


        $statement = $pdo->prepare($query);


        $statement->execute();


        header('Location: /index.php');
        exit();
    }
}

$query = 'SELECT * FROM friend';

$statement = $pdo->prepare($query);
$statement->execute();
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <li>

            <?php

            foreach ($friends as $friend) {

            ?>
                <ul>
                    <li>
                        <?php echo $friend['firstname'] . PHP_EOL ?>
                        <?php echo $friend['lastname'] ?>
                    </li>
                </ul>
            <?php

            }
            ?>

        </li>
    </ul>

    <form method="post" action="index.php">
        <div>
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="firstname">
        </div>
        <div>
            <label for="lastname">Lastname :</label>
            <input type="text" id="lastname" name="lastname">
        </div>
        <div class="button">
            <button type="submit">Envoyer</button>
        </div>
    </form>
</body>

</html>