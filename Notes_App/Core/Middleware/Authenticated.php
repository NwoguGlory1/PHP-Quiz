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
        //  if ($_SESSION['role'] == 'supervisor') {
        //     // Supervisors can access all pages, including the dashboard
        //     return; // Allow access to all pages
        // }

        
        // If the user is an agent and approved, allow them to access dashboard
        if ($_SESSION['role'] == 'agent' && $_SESSION['approved'] == true) {
            return; // Allow access
            // header('location: /dashboard');
            // exit();
        // } else {
        //     // If agent is not approved, check if request was already sent
        //     if (!$_SESSION['request_sent']) {
        //         // Mark request as sent in the database
                    
        //         $stmt = $pdo->prepare("UPDATE users SET request_sent = TRUE WHERE id = ?");
        //         $stmt->execute([$_SESSION['user_id']]);

        //         echo "Approval request sent to the supervisor.";
        //     }
        //      // Display waiting approval message
        //      echo "<button disabled>Waiting Approval</button>";
        
        // Check session expiration
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $_SESSION['expire_time']) {
            // Session expired, logout the user
            logout(); // Call your logout function to clear session and cookies
            header('Location: /login');
            exit();
        }}
    
    
    // Update last activity time to extend session while active
    $_SESSION['last_activity'] = time();

        
    }
}