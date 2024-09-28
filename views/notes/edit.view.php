<?php
view('partials/head', compact('pageTitle'));
view('partials/nav');
?>

<main class="container mx-auto py-8 px-4">
    <form class="max-w-3xl mx-auto" method="POST" action="/note">
        <?php if (isset($errors['insert'])): ?>
            <div class="mb-5">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= htmlspecialchars($errors['insert'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>

        <div class="mb-5">
            <label for="title" class="block mb-2 font-medium text-gray-900 dark:text-white">Note Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>" class="shadow-sm bg-gray-50 border <?= isset($errors['title']) ? 'border-red-500' : '' ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
            <?php if (isset($errors['title'])): ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= htmlspecialchars($errors['title'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-5">
            <label for="noteContent" class="block mb-2 text-gray-900 dark:text-white">Note Content:</label>
            <textarea id="noteContent" name="noteContent" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border <?= isset($errors['noteContent']) ? 'border-red-500' : '' ?> focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your note..."><?= htmlspecialchars($noteContent, ENT_QUOTES, 'UTF-8') ?></textarea>
            <?php if (isset($errors['noteContent'])): ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= htmlspecialchars($errors['noteContent'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
        </div>

        <div class="flex mt-4">
            <input type="hidden" name="id" value=<?= $noteID ?>>
            <input type="hidden" name="_method" value="PATCH">
            <button type="button" class="inline-flex mr-2 font-semibold items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md transition-colors duration-300">Delete</button>
            <button type="submit" class="inline-flex mr-2 font-semibold items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm rounded-md transition-colors duration-300">Update</button>
        </div>
    </form>
</main>

<script>
    const deleteButton = document.querySelector('button[type="button"]');
    deleteButton.addEventListener('click', () => {
        document.querySelector('input[name="_method"]').value = 'DELETE';
        deleteButton.form.submit();
    })
</script>

<?php
view('partials/footer');
?>
