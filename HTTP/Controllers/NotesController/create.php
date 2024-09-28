<?php
$pageTitle = "Create Note";

$title = '';
$noteContent = '';
$errors = [];

view('notes/create', compact('pageTitle', 'title', 'noteContent', 'errors',));
