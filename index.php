<?php
require_once("connection.php");
require_once("classes/Client.php");
$record = new Client($conn);
$edit_data = null;
if (isset($_GET["search"])) {
    $keyword = trim($_GET["keyword"] ?? "");
    $records = $record->search($keyword);
} else {
    $records = $record->getAll();
}
if (isset($_GET["edit"])) {
    $edit_id = $_GET["edit"];
    foreach ($records as $row) {
        if ($row["client_id"] == $edit_id) {
            $edit_data = $row;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gym Client Information System</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<div class="hero"><h1>Gym Client Information System</h1><p>Simple PHP PDO OOP CRUD System</p></div>
<div class="note">This simple version directly follows the Clients entity in the Prelim ERD: ClientID, FirstName, LastName, Gender, BirthDate, ContactNumber, Address, and Email.</div>
<?php if (isset($_GET["message"])): ?>
<div class="message"><?php
if ($_GET["message"] == "added") echo "Record added successfully.";
if ($_GET["message"] == "updated") echo "Record updated successfully.";
if ($_GET["message"] == "deleted") echo "Record deleted successfully.";
?></div>
<?php endif; ?>
<div class="box">
<h2><?= $edit_data ? "Update Record" : "Add Record"; ?></h2>
<form action="handler.php" method="POST">
<?php if ($edit_data): ?><input type="hidden" name="client_id" value="<?= $edit_data["client_id"]; ?>"><?php endif; ?>
<div class="form-grid"><div><label>First Name</label><input type="text" name="first_name" value="<?= htmlspecialchars($edit_data["first_name"] ?? ""); ?>"></div><div><label>Last Name</label><input type="text" name="last_name" value="<?= htmlspecialchars($edit_data["last_name"] ?? ""); ?>"></div><div><label>Gender</label><select name="gender"><option value="">Select</option><option value="Male" <?= ($edit_data["gender"] ?? "") == "Male" ? "selected" : ""; ?>>Male</option><option value="Female" <?= ($edit_data["gender"] ?? "") == "Female" ? "selected" : ""; ?>>Female</option></select></div><div><label>Birth Date</label><input type="date" name="birth_date" value="<?= htmlspecialchars($edit_data["birth_date"] ?? ""); ?>"></div><div><label>Contact Number</label><input type="text" name="contact_number" value="<?= htmlspecialchars($edit_data["contact_number"] ?? ""); ?>"></div><div><label>Address</label><input type="text" name="address" value="<?= htmlspecialchars($edit_data["address"] ?? ""); ?>"></div><div><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($edit_data["email"] ?? ""); ?>"></div></div>
<?php if ($edit_data): ?>
<button type="submit" name="update_record" class="btn">Update</button><a href="index.php" class="cancel">Cancel</a>
<?php else: ?>
<button type="submit" name="add_record" class="btn">Add</button>
<?php endif; ?>
</form>
</div>
<div class="box">
<div class="table-header"><h2>Records</h2><form method="GET" class="search"><input type="text" name="keyword" placeholder="Search records" value="<?= htmlspecialchars($_GET["keyword"] ?? ""); ?>"><button type="submit" name="search" class="btn">Search</button><a href="index.php" class="cancel">Clear</a></form></div>
<div class="table-container"><table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Birth Date</th><th>Contact Number</th><th>Address</th><th>Email</th><th>Action</th></tr></thead><tbody>
<?php foreach ($records as $row): ?><tr><td><?= $row["client_id"]; ?></td><td><?= htmlspecialchars($row["first_name"]); ?></td><td><?= htmlspecialchars($row["last_name"]); ?></td><td><?= htmlspecialchars($row["gender"]); ?></td><td><?= htmlspecialchars($row["birth_date"]); ?></td><td><?= htmlspecialchars($row["contact_number"]); ?></td><td><?= htmlspecialchars($row["address"]); ?></td><td><?= htmlspecialchars($row["email"]); ?></td><td class="actions"><a href="index.php?edit=<?= $row["client_id"]; ?>" class="edit">Edit</a><form action="handler.php" method="POST" onsubmit="return confirm('Delete this record?');"><input type="hidden" name="client_id" value="<?= $row["client_id"]; ?>"><button type="submit" name="delete_record" class="delete">Delete</button></form></td></tr><?php endforeach; ?>
<?php if (count($records) == 0): ?><tr><td colspan="9">No record found.</td></tr><?php endif; ?>
</tbody></table></div>
</div>
</div>
</body>
</html>
