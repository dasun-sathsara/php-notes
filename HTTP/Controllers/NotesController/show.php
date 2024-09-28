<?php

use Core\Database;
use Core\Response;
use Core\App;
use Core\Session;

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

$userName = $user['name'];
$title = $note['title'];
$noteContent = $note['content'];
$pageTitle = $note['title'];

view('notes/show', compact('pageTitle', 'title', 'noteContent', 'userName', 'noteID'));
