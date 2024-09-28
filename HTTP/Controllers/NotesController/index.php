<?php

use Core\{App, Database, Session};

$pageTitle = "My Notes";

$currentUserID = Session::get('userID');

$db = App::resolve(Database::class);

$notes = $db->fetchAll("SELECT * FROM notes WHERE user_id = :user_id", ['user_id' => $currentUserID]);

view('notes/index', compact('pageTitle', 'notes'));
