<?php
// controller to handle agent's request
// see a list of agents who have requested approval and are awaiting authorization.

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

// // On the Supervisor's Dashboard
$stmt = $db->query('SELECT id, firstname, email FROM users WHERE role = "agent" AND approved = FALSE AND request_sent = TRUE');
$pending_agents = $stmt->get();  // Fetch the agents waiting for approval
//  dd($pending_agents);

view("session/supervisor-dashboard.view.php", [
    'heading' => '',
    'pending_agents' => $pending_agents
]);