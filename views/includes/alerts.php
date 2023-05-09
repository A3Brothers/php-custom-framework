<?php if ($message = sessionMessages('success')) : ?>
    <h2 class="text-center font-bold text-sm bg-green-400 text-red-600"><?= $message ?></h2>
<?php endif; ?>

<?php if ($message = sessionMessages('error')) : ?>
    <h2 class="text-center font-bold text-sm bg-red-700 text-white"><?= $message ?></h2>
<?php endif; ?>