<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$type = empty($_GET['type']) ? 'hour' : $_GET['type'];

if ($type === 'hour') {
    $table = 'session';
    $foreign = 'mv.idmovie_session';
} else {
   echo "stop";
}

$statement = $pdo->prepare("SELECT session, mv.idsession from $table JOIN movie_session as mv ON $table.idsession=mv.idsession WHERE $foreign = ?");
$statement->execute([$_GET['filter']]);
$items = $statement->fetchAll();

header('Content-Type: application/json');
echo json_encode(array_map(function ($item) {
    return [
        'label' => $item['session'],
        'value' => $item['idsession']
    ];
}, $items));