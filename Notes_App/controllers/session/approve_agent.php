<?php

// controller to approve process the approval of an agent by updating the database


// Sanitize and validate the id.
// Approve the agent in the database.
// Redirect the user back to the Supervisor’s Dashboard
use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

// Make sure only supervisors can access this page
if ($_SESSION['role'] != 'supervisor') {
    header('Location: login.php');
    exit();
}

// Check if the id is passed in the URL
// Get agent ID from the URL
$agent_id =  $_POST['id'] ?? null; //Since the form in supervisor-dashboard.view uses POST, you fetch id from $_POST:
// dd($agent_id );

if ($agent_id && filter_var($agent_id, FILTER_VALIDATE_INT)) {
    // Sanitize the agent_id and ensure it is a valid integer
    $agent_id = (int) $agent_id;


    $db->query('UPDATE users SET approved = TRUE, request_sent = FALSE WHERE id = :id', [
        'id' => $agent_id
    ]);
    
    // Redirect to the Supervisor's Dashboard
    header('location: /supervisor-dashboard');
    exit();
} else {
    // Handle the case where no ID is provided
    echo "Invalid request.";
}



view("approve_agent.view.php" , ['heading' => '']);


