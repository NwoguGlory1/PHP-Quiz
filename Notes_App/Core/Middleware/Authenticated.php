<?php
// handles what the user can access if authenticated


namespace Core\Middleware;

class Authenticated
{
    public function handle()
    {
     
        if (! $_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }

         // Check if user is a supervisor or an approved agent
         if ($_SESSION['role'] == 'supervisor') {
            // Supervisors can access all pages, including the dashboard
            return; // Allow access to all pages
        }

        if ($_SESSION['role'] == 'agent' && $_SESSION['approved'] == false) {
            // Redirect agents who are not approved to the home page, cannot see dashboard
            header('Location: /');
            exit();
        }
        
        // If the user is an agent and approved, allow them to access dashboard
        if ($_SESSION['role'] == 'agent' && $_SESSION['approved'] == true) {
            return; // Allow access
        }
        
        // Check session expiration
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $_SESSION['expire_time']) {
            // Session expired, logout the user
            logout(); // Call your logout function to clear session and cookies
            header('Location: /login');
            exit();
        }
    
    
    // Update last activity time to extend session while active
    $_SESSION['last_activity'] = time();

        
    }
}