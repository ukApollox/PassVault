<?php
require "templates/header.php";
?>

<div class="flex items-center justify-center min-h-screen bg-white">
    <form action="#" method="POST" class="space-y-12 w-full max-w-md bg-white p-6 rounded-md shadow-md">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="url_or_software_name" class="block text-sm font-medium text-gray-900">URL or Software Name</label>
                    <div class="mt-2">
                        <input id="url_or_software_name" name="url_or_software_name" type="text" autocomplete="username" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" autocomplete="username" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="text" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 sm:text-sm">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-4">
            <button type="button" class="text-sm font-semibold text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">Save</button>
        </div>
    </form>
</div>
