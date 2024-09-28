<?php

$pageTitle = "403 Unauthorized";

view('partials/head', compact('pageTitle'));
view('partials/nav');
?>

<!-- Banner -->
<div class="bg-gradient-to-r from-green-500 to-blue-500 text-white py-14 ">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4 animate-fadeIn">403. Unauthorized.</h1>
        <p class="text-lg mb-6">Sorry, you are not authorized to access this page.</p>
        <a href="/" class="text-lg underline">Go back to the homepage</a>
    </div>
</div>

<?php
view('partials/footer');
?>
