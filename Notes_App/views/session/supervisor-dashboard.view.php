<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

  <main>
  <!-- <h1>Supervisor's Dashboard</h1> -->
  <h2 style="text-align: center; font-weight: bold;">Pending Agent Requests</h2>
    <br>

    <?php if (!empty($pending_agents)): ?>
        <ul>
            <?php foreach ($pending_agents as $pending_agent): ?>
                
                <li style="margin-bottom: 10px;">
                    <?= htmlspecialchars($pending_agent['firstname']) ?> <?= htmlspecialchars ($pending_agent['email'])?>
                    <form class="space-y-6" action="/supervisor-dashboard" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($pending_agent['id']) ?>">
                        <button type="submit"  style="text-decoration: none; background-color: #4CAF50; color: white; padding: 5px 10px; border-radius: 5px; font-weight: normal; display: inline-block;">Approve</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>

        <br>
        <p><i>No pending requests at the moment...</i></p>
    <?php endif; ?>

  </main>

  <?php require base_path('views/partials/footer.php') ?>

 
