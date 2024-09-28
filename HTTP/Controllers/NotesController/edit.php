<?php

use Core\{Database, Response, App, Session};

$currentUserID = Session::get('userID');
$noteID = $_GET['id'];

$db = App::resolve(Database::class);

$note = $db->fetchOne("SELECT * FROM notes WHERE id = :id ", [
    'id' => $noteID
]);

if (!$note) {
    abort(Response::NOT_FOUND);
}

if ($note['user_id'] !== $currentUserID) {
    abort(Response::UNAUTHORIZED);
}

$user = $db->fetchOne("SELECT * FROM users WHERE id = :id", [
    'id' => $currentUserID
]);

$pageTitle = "Edit Note";
$title = $note['title'];
$noteContent = $note['content'];
$errors = [];

view('notes/edit', compact('pageTitle', 'title', 'noteContent', 'errors', 'noteID'));
