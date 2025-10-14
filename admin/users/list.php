<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Users"); ?>

<p><a href="#" onclick="openModal()">➕ Add New User</a></p>

<form method="get">
  <input type="text" name="q" placeholder="Search users..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Name', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th><?= sortLink('Username', 'username', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Email</th>
      <th>Role</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $limit = 10;
    $page = max(1, intval($_GET['page'] ?? 1));
    $offset = ($page - 1) * $limit;

    $q = $conn->real_escape_string($_GET['q'] ?? '');
    $sort = $_GET['sort'] ?? 'entry_date_time';
    $dir = $_GET['dir'] ?? 'desc';

    $allowedSorts = ['name', 'username', 'email', 'role', 'status'];
    $allowedDirs = ['asc', 'desc'];
    if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
    if (!in_array($dir, $allowedDirs)) $dir = 'desc';

    $sql = "SELECT * FROM users";
    if ($q !== '') {
      $sql .= " WHERE username LIKE '%$q%' OR email LIKE '%$q%'";
    }

    $sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['username']}</td>
        <td>{$row['email']}</td>
        <td>{$row['role']}</td>
        <td>{$row['status']}</td>
        <td>
		<a href='#' onclick='editItem({$row['key_user']},\"get_user.php\",
		  [\"name\", \"username\", \"email\", \"role\", \"status\",
			\"phone\", \"address\", \"city\", \"state\", \"country\", \"url\", \"description\"]
		)'>Edit</a>          
          <a href='delete.php?id={$row['key_user']}' onclick='return confirm(\"Delete this user?\")'>Delete</a>
        </td>
      </tr>";
    }

    $countSql = "SELECT COUNT(*) AS total FROM users";
    if ($q !== '') {
      $countSql .= " WHERE username LIKE '%$q%' OR email LIKE '%$q%'";
    }
    $total = $conn->query($countSql)->fetch_assoc()['total'];
    $totalPages = ceil($total / $limit);
    ?>
  </tbody>
</table>

<div id="pager">
  <?php if ($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">⬅ Prev</a>
  <?php endif; ?>
  Page <?= $page ?> of <?= $totalPages ?>
  <?php if ($page < $totalPages): ?>
    <a href="?page=<?= $page + 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">Next ➡</a>
  <?php endif; ?>
</div>

<!-- Modal Form — Add/Edit -->
<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>

	<h3 id="modal-title">Add User</h3>
	<form id="modal-form" method="post">
	  <input type="hidden" name="key_user" id="key_user">

	  <input type="text" name="name" id="name" 
			 onchange="setCleanURL(this.value)" 
			 placeholder="Full Name" 
			 required maxlength="200"><br>

	  <input type="text" name="username" id="username" 
			 placeholder="Username" 
			 required maxlength="100"><br>

	  <input type="email" name="email" id="email" 
			 placeholder="Email" 
			 maxlength="200"><br>

	  <input type="text" name="phone" id="phone" 
			 placeholder="Phone" 
			 maxlength="20"><br>

	  <textarea name="address" id="address" 
				placeholder="Address"></textarea><br>

	  <input type="text" name="city" id="city" 
			 placeholder="City" 
			 maxlength="100"><br>

	  <input type="text" name="state" id="state" 
			 placeholder="State" 
			 maxlength="100"><br>

	  <input type="text" name="country" id="country" 
			 placeholder="Country" 
			 maxlength="100"><br>

	  <input type="text" name="url" id="url" 
			 placeholder="Slug" 
			 maxlength="200" 
			 pattern="^[a-z0-9\-\/]+$" 
			 title="Lowercase letters, numbers, and hyphens only"><br>

	  <textarea name="description" id="description" 
				placeholder="Description"></textarea><br>

	  <input type="password" name="password" id="password" 
			 placeholder="Password" 
			 maxlength="255"><br>
		<br>
	  <select name="role" id="role" required>
		<option value="">--Select Role--</option>
		<option value="admin">Admin</option>
		<option value="creaditor">Creaditor</option>
		<option value="editor">Editor</option>
		<option value="viewer">Viewer</option>
	  </select><br>
		
		<br>
	  
	  <label>
		<input type="checkbox" name="status" id="status" 
			   value="on" checked>
		Active
	  </label><br>

	  <input type="submit" value="Save">

	</form>

</div>

<?php endLayout(); ?>
