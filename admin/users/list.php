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
		<td class='record-action-links'>
		<a href='#' onclick='editItem({$row['key_user']},\"get_user.php\",
		  [\"name\", \"username\", \"email\", \"role\", \"status\",
			\"phone\", \"address\", \"city\", \"state\", \"country\", \"url\", \"description\"]
		)'>Edit</a> 
		  <a href='delete.php?id={$row['key_user']}' onclick='return confirm(\"Delete this user?\")' style='display:none'>Delete</a>
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

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add User</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_user" id="key_user">
		<input type="text" name="name" id="name" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Full Name</label><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens"> <label>Slug</label><br>
		<input type="text" name="username" id="username" required maxlength="100"> <label>Username</label><br>
		<input type="password" name="password" id="password" maxlength="255"> <label>Password</label><br>
		<input type="email" name="email" id="email" maxlength="200"> <label>Email</label><br>
		<input type="text" name="phone" id="phone" maxlength="20"> <label>Phone</label><br>
		<textarea name="address" id="address" placeholder="Address" title="Address"></textarea><br>
		<input type="text" name="city" id="city" maxlength="100"> <label>City</label><br>
		<input type="text" name="state" id="state" maxlength="100"> <label>State</label><br>
		<input type="text" name="country" id="country" maxlength="100"> <label>Country</label><br>
		<textarea name="description" id="description" placeholder="Description" title="Description"></textarea><br>
		<select name="role" id="role" required>
			<option value="">Select Role</option>
			<option value="admin">Admin</option>
			<option value="creaditor">Creaditor</option>
			<option value="editor">Editor</option>
			<option value="viewer">Viewer</option>
		</select> <label>Role</label><br>
		<br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<?php endLayout(); ?>