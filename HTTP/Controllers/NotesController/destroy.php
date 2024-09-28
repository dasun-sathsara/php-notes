<?php

use Core\{App, Database, Response, Session};

$noteID = $_POST['id'];

$currentUserID = Session::get('userID');

$db = App::resolve(Database::class);

$noteContent = $db->fetchOne("SELECT * FROM notes WHERE id = :id ", [
    'id' => $noteID
]);

if (!$noteContent) {
    abort(Response::NOT_FOUND);
}

if ($noteContent['user_id'] !== $currentUserID) {
    abort(Response::UNAUTHORIZED);
}


try {
    $db->query("DELETE FROM notes WHERE id = :id", [
        'id' => $noteID
    ]);
    header('Location: /notes');
    exit;
} catch (PDOException $e) {
    abort(Response::INTERNAL_SERVER_ERROR);
}
