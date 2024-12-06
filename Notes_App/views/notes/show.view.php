<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
       <p>
            <a href="/notes" class="text-blue-500 underline"> Go back..</a>
        </p>
        <p>
            <?= htmlspecialchars($note['body']) ?>
        </p>
    </div>
  </main>

  <form class="mt-6" method="POST">
    <!-- We hide the id of the note we are submitting when Delete is clicked -->
      <input type="hidden" name="id" value="<?= $note['id'] ?>">
        <button class="text-sm text-red-500">Delete</button>
  </form>

  <?php require base_path('views/partials/footer.php') ?>
