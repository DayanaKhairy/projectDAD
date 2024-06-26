<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Certiment 2.0</title>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Certiment</h2>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="ProfileEmp.php"><i class='bx bxs-user'></i>Personal Information</a></li>
                <li><a href="employer.php"><i class='bx bxs-user-detail'></i></i>Employees</a> </li>
                <li><a href="portfolioEmp.php"><i class='bx bx-folder'></i>Discover</a> </li>
                <li><a href="document.php"><i class='bx bx-file'></i>Documents</a> </li>
                <li><a href="#" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a></li>
            </ul>
        </nav>
    </aside>
</body>
<script>
function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
        window.location.href = "logout.php"; // Redirect to logout page
    }
}
</script>

</html>