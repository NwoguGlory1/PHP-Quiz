<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php $errors = $_SESSION['errors'] ?? [];

$_SESSION['name'] = 'Daraja';

// unset($_SESSION['errors']); ?>

  <main>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <!-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"> -->
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create Account Form</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <form class="space-y-6" action="/register" method="POST">
      <div>
        <label for="firstname" class="block text-sm/6 font-medium text-gray-900">First Name</label>
        <div class="mt-2">
          <input type="firstname" name="firstname" id="firstname" autocomplete="firstname" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
          value="<?= isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8') : ''?>" >
        </div>
      </div>

      <div>
        <label for="lastname" class="block text-sm/6 font-medium text-gray-900">Last Name</label>
        <div class="mt-2">
          <input type="lastname" name="lastname" id="email" autocomplete="lastname" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <form class="space-y-6" action="/register" method="POST">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>
        
      <!-- Validation for Email-->
      <?php if (isset($errors['email'])) : ?> 
              <p class="text-red-500 text-xs mt-2"> 
                <?= $errors['email'] ?>
              </p>
              <?php endif; ?>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500"></a>
          </div>
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <!-- Validation for password -->
      <?php if (isset($errors['password'])) : ?> 
              <p class="text-red-500 text-xs mt-2"> 
                <?= $errors['password'] ?>
              </p>
              <?php endif; ?>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Account </button>
      </div>
    </form>
  </div>
</div>

  </main>

  <?php require base_path('views/partials/footer.php') ?>