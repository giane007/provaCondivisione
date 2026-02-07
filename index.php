<?php

$db = new PDO(
    'mysql:host=192.168.60.144;dbname=dessant_mustafaj_itis;charset=utf8mb4',
    'dessant_mustafaj',
    'danzavamo.allandare.',

    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]

);

//READ

$query = 'SELECT * FROM studenti';

try {
    $stmt = $db->prepare($query);
    $stmt->execute();

    while ($user = $stmt->fetch()) {
        echo "ID:". $user->id. '<br>';
        echo "nome:". $user->nome . '<br>';
        echo "cognome:". $user->cognome . '<br>';
        echo "media:". $user->media . '<br>';
        echo "data_iscrizione:". $user->data_iscrizione . '<br>';
        echo "<hr>";
    }
    $stmt->closeCursor();
}catch(PDOException $e) {
    echo "A DB error occured. Please try again later. ";
}


//READ 2

$query = 'SELECT media, cognome FROM studenti where nome = :name';

try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name','Antonio',PDO::PARAM_STR);
    $stmt->execute();

    while ($user = $stmt->fetch()) {

        echo "cognome:". $user->cognome . '<br>';
        echo "media:". $user->media . '<br>';
        echo "<hr>";
    }
    $stmt->closeCursor();
}catch(PDOException $e) {
    echo "A DB error occured. Please try again later. ";
}

//CREATE

$query = 'INSERT INTO studenti(nome,cognome,media,data_iscrizione)
          VALUES (  :nome, :cognome, :media, NOW())';

try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(':nome','Lucy',PDO::PARAM_STR);
    $stmt->bindValue(':cognome','Taylor',PDO::PARAM_STR);
    $stmt->bindValue(':media','8',PDO::PARAM_INT);
    $stmt->execute();
    echo "Insert succesful.";
    $stmt->closeCursor();
}catch(PDOException $e) {
    // error_log($e->getMessage());
    echo "A DB error occured. Please try again later. ";
}
