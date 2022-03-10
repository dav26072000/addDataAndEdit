<?php
    require 'configDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div class="w-full flex justify-center items-center">
        <div class="w-11/12">
            <form class="form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="check.php" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                        First Name
                    </label>
                    <input
                        class="inputElement shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Username" name="firstName">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                        Last Name
                    </label>
                    <input
                        class="inputElement shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Last name" name="lastName">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                        Date of Birth
                    </label>
                    <input
                        class="inputElement shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="date" name="date">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="inputElement shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="email" placeholder="email" name="email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phoneNumber">
                        Phone Number
                    </label>
                    <input
                        class="inputElement shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        type="tel" placeholder="+37477777777" name="phoneNumber">
                    <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="submit w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                        Submit
                    </button>
                </div>
            </form>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Id
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            First Name
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Last Name
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Date of Birth
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Email
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Phone Number
                                        </th>
                                        <th scope="col" class="relative py-3 px-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product 1 -->
                                    <?php
                                        $result = $mysql->query("SELECT * FROM `usersinfo`");
                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                              <tr id='row{$row["id"]}' class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                                                <td class='py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                                    {$row["id"]}
                                                </td>
                                                <td id='firstName{$row["id"]}' class='py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400'>
                                                    {$row["firstName"]}
                                                </td>
                                                <td id='lastName{$row["id"]}' class='py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400'>
                                                    {$row["lastName"]}
                                                </td>
                                                <td id='date{$row["id"]}' class='py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400'>
                                                    {$row["date"]}
                                                </td>
                                                <td id='email{$row["id"]}' class='py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400'>
                                                    {$row["email"]}
                                                </td>
                                                <td id='phoneNumber{$row["id"]}' class='py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400'>
                                                    {$row["phoneNumber"]}
                                                </td>
                                                <td class='py-4 px-6 text-sm font-medium text-right whitespace-nowrap'>
                                                    <button id='editButton{$row["id"]}' onClick='editRow({$row["id"]})' class='edit text-blue-600 dark:text-blue-500 hover:underline'>Edit </button>
                                                    <button id='saveButton{$row["id"]}' onClick='saveRow({$row["id"]})' class='saveButton text-blue-600 dark:text-blue-500 hover:underline'>Save </button>
                                                    <button id='deleteButton{$row["id"]}' onClick='deleteRow({$row["id"]})' class='delete text-red-600 dark:text-blue-500 hover:underline'> Delete</button>
                                                </td>
                                              </tr>
                                            ";
                                        }
                                    ?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>