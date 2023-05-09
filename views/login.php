<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include_once BASEPATH . 'views/includes/navbar.php' ?>
    <?php include_once BASEPATH . 'views/includes/alerts.php' ?>

    <?php if (isset($success)) : ?>
        <h2 class="text-center font-bold text-sm bg-green-400 text-red-600">User has been logged in successfully!</h2>
    <?php endif; ?>
    <div class="">
        <div class="form flex justify-center items-center h-screen flex-col">
            <h2 class="text-center h2 font-bold text-lg">User Login</h2>

            <form action="<?= $loginPost ?>" method="post" class="border border-gray-300 p-4 rounded-lg bg-blue-200 space-y-4 w-1/2">
                <div class="input-div flex justify-between">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="border w-1/2" placeholder="Add email here..." inputmode="email" required>
                </div>
                <div class="input-div flex justify-between">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="border w-1/2" placeholder="Add password here..." inputmode="password" required>
                </div>
                <div class="text-center"><button type="submit" class="bg-red-300 text-white p-2 m-2 rounded hover:bg-red-600">Login</button></div>
            </form>
        </div>
    </div>
</body>

</html>