<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

 <main>

 Hello, <?= $_SESSION['user']['firstname'] ?? 'Guest' ?>,
 this is your email address: <?= $_SESSION['user']['email'] ?? '' ?>
      
</main>
      
<?php require base_path('views/partials/footer.php') ?>
