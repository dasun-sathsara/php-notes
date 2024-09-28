<?php

use Core\Session;
?>

<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center">
            <div class="flex space-x-10">
                <div>
                    <a id="logo" href="/" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">ModernSite</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/" class="<?= url_is('/') ? 'border-b-2 border-green-500 text-green-500' : 'hover:text-green-500' ?> py-1 px-3 text-gray-500 font-semibold">Home</a>
                    <a href="/notes" class="<?= url_is('/notes') ? 'border-b-2 border-green-500 text-green-500' : 'hover:text-green-500' ?> py-1 px-3 text-gray-500 font-semibold">Notes</a>
                    <a href="/about" class="<?= url_is('/about') ? 'border-b-2 border-green-500 text-green-500' : 'hover:text-green-500' ?> py-1 px-3 text-gray-500 font-semibold">About</a>
                    <a href="/services" class="<?= url_is('/services') ? 'border-b-2 border-green-500 text-green-500' : 'hover:text-green-500' ?> py-1 px-3 text-gray-500 font-semibold">Services</a>
                    <a href="/contact" class="<?= url_is('/contact') ? 'border-b-2 border-green-500 text-green-500' : 'hover:text-green-500' ?> py-1 px-3 text-gray-500 font-semibold">Contact</a>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-3">
                <?php if (Session::has('userID')): ?>
                    <form action="/session" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 transition-all duration-300 ease-in-out">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 transition-all duration-300 ease-in-out">Login</a>
                    <a href="/register" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-all duration-300 ease-in-out">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
