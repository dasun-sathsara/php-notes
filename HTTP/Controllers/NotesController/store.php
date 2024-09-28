<?php

use Core\Database;
use Core\Validator;
use Core\App;
use Core\Session;

$pageTitle = "Create Note";

$title = '';
$noteContent = '';
$db = App::resolve(Database::class);
$errors = [];

$title = $_POST['title'];
$noteContent = $_POST['noteContent'];

if (!Validator::string($title, 3, 100)) {
    $errors['title'] = 'Title must be between 3 and 100 characters.';
}

if (!Validator::string($noteContent, 10, INF)) {
    $errors['noteContent'] = 'Note must be at least 10 characters.';
}

if (empty($errors)) {
    try {
        $db->query('INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)', [
            'title' => $title,
            'content' => $noteContent,
            'user_id' => Session::get('userID'),
        ]);

        header('Location: /notes');
        exit;
    } catch (PDOException $e) {
        $errors['insert'] = 'Failed to insert the note. Please try again later.';
    }
}

view('notes/create', compact('pageTitle', 'title', 'noteContent', 'errors'));
