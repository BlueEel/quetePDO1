<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

// A exécuter afin d'afficher vos lignes déjà insérées dans la table friends
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

// A exécuter afin d'insérer une ligne dans votre table friends
$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
$statement = $pdo->exec($query);

// A exécuter afin de tester le contenu de votre table friend
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

$friends = $statement->fetchAll(PDO::FETCH_BOTH); // same as $statement->fetchAll()
var_dump($friends);

// A exécuter afin de tester le contenu de votre table friend
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

// On veut afficher notre résultat via un tableau associatif (PDO::FETCH_ASSOC)
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($friendsArray as $friend) {
    echo $friend['firstname'] . ' ' . $friend['lastname'];
}

// On veut afficher notre résultat via un tableau associatif (PDO::FETCH_OBJ)
$friendsObject = $statement->fetchAll(PDO::FETCH_OBJ);

foreach ($friendsObject as $friend) {
    echo $friend->firstname . ' ' . $friend->lastname;
}
