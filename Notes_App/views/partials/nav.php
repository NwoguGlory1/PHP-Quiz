<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <!-- <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company"> -->
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="/" class="<?=urlIs('/') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700  px-3 py-2 rounded-md text-sm font-medium" >Home</a>
              <a href="/about" class="<?=urlIs('/about.php') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >About</a>
              <a href="/contact" class="<?=urlIs('/contact.php') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >Contact</a>
              
              <?php if ($_SESSION['user'] ?? false) : ?>
                           
                <?php if ($_SESSION['role'] == 'supervisor' || $_SESSION['approved'] == true) : ?>
                  <a href="/notes" class="<?=urlIs('/notes.php') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >Notes</a>
                  <a href="/dashboard" class="<?=urlIs('/dashboard.php') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >Dashboard</a>
                <?php endif ?>
              <?php endif ?>
            </div>
          </div>
        </div>

        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="px-5">
            <?php if ($_SESSION['user'] ?? false) : ?>
            <!-- Show the bell notification if the user is logged in -->
            <div class="flex items-center space-x-4">
                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                <button class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 10-12 0v3c0 .417-.152.816-.405 1.116L4 17h5m6 0a3 3 0 01-6 0m6 0H9"></path>
                    </svg>
                </button>
              </div>
                <div class="ml-3">
                  <form method="POST" action="/session">
                    <input type="hidden" name="_method" value="DELETE"/>
                      <button class="text-white" >Log Out</button>
                  </form>
                </div>
          <?php else : ?>
              <a href="/register" class="<?=urlIs('/register') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >Register</a>
              <a href="/login" class="<?=urlIs('/login') ? 'bg-gray-900 text-white': 'text-gray-300' ?> hover:bg-gray-700 hover:text-white  px-3 py-2 rounded-md text-sm font-medium" >Login</a>
              <?php endif; ?>
            </div>

        </div>
        <!-- <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div> -->
      </div>
    </div>
  </nav>