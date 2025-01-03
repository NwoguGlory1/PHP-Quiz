<?php
// handles what the user can access if authenticated


namespace Core\Middleware;

use Core\App;
use Core\Database;

class Authenticated
{
    public function handle()
    {
     
        if (! $_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }

        // Check session expiration
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $_SESSION['expire_time']) {
             // Resolve the database instance
            $db = App::resolve(Database::class);

            // Reset approval status
            $db->query('UPDATE users SET approved = FALSE WHERE id = :id', [
                'id' => $_SESSION['user_id']
            ]); // By placing App::resolve(Database::class) inside the condition, the database connection is only created when the condition is met (i.e., when the session expires).

            // Session expired, logout the user
            logout(); // Call your logout function to clear session and cookies
            header('Location: /login');
            exit();
        }
    
    
    // Update last activity time to extend session while active
    $_SESSION['last_activity'] = time();
        
    }
}