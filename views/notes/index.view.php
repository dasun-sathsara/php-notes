<?php

view('partials/head', compact('pageTitle'));
view('partials/nav');
view('partials/hero', compact('pageTitle'));

?>

<main class="container mx-auto py-8 px-4">
    <div class="max-w-2xl mx-auto space-y-3">
        <div class="mb-6">
            <a href="/notes/create" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition-all duration-300 ease-in-out">Create Note</a>
        </div>
        <?php foreach ($notes as $noteContent): ?>
            <a href="/note?id=<?= htmlspecialchars($noteContent['id'], ENT_QUOTES, 'UTF-8') ?>" class="block note-card bg-white p-3 rounded-lg shadow-md">
                <h2 class="text-lg text-gray-700 hover:text-green-500 transition-colors duration-300"><?= htmlspecialchars($noteContent['title'], ENT_QUOTES, 'UTF-8') ?></h2>
            </a>
        <?php endforeach; ?>
    </div>
</main>

<?php
view('partials/footer');

?>
