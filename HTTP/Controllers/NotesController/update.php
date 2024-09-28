<?php

use Core\{App, Database, Response, Validator, Session};

$currentUserID = Session::get('userID');
$noteID = $_POST['id'];

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

$pageTitle = "Update Note";
$title = $_POST['title'];
$noteContent = $_POST['noteContent'];
$errors = [];

if (!Validator::string($title, 3, 100)) {
    $errors['title'] = 'Title must be between 3 and 100 characters.';
}

if (!Validator::string($noteContent, 10, INF)) {
    $errors['noteContent'] = 'Note must be at least 10 characters.';
}

if (empty($errors)) {
    try {
        $db->query("UPDATE notes SET title = :title, content = :content WHERE id = :id", [
            'title' => $title,
            'content' => $noteContent,
            'id' => $noteID
        ]);

        header('Location: /notes');
        exit;
    } catch (PDOException $e) {
        $errors['update'] = "There was an error updating the note.";
    }
}

view('notes/edit', compact('pageTitle', 'title', 'noteContent', 'errors', 'noteID'));
