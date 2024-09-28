<?php
view('partials/head', compact('pageTitle'));
view('partials/nav');
?>

<main class="container mx-auto py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="./notes" class="inline-flex font-semibold items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm rounded-md transition-colors duration-300">
                ← Back to Notes
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
                <div class="mb-3">
                    <p class="text-sm text-gray-600">Created by: <span class="font-semibold"><?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></span></p>
                </div>
                <div class="prose max-w-none">
                    <?= htmlspecialchars($noteContent, ENT_QUOTES, 'UTF-8') ?>
                </div>

                <div class="flex mt-2 justify-end">
                    <a href="/note/edit?id=<?= $noteID ?>" class="inline-flex font-semibold items-center px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm rounded-md transition-colors duration-300">Edit</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
view('partials/footer');
?>
