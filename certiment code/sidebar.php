<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Certiment 2.0</title>
    <style>
    /* Add some styles for the collapsed sidebar */
    .sidebar.collapsed {
        width: 50px;
        /* Set your desired collapsed width */
    }

    .sidebar.collapsed .menu-text {
        display: none;
    }

    .sidebar.collapsed .bx {
        margin-right: 0;
    }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header" onclick="toggleSidebar()">
            <h2>Certiment</h2>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="home.php"><i class='bx bxs-user'></i>Personal Information</a></li>
                <li class="has-submenu">
                    <a href=""><i class='bx bx-file'></i>File Management</a>
                    <ul class="submenu">
                        <li><a href="upload.php">Upload</a></li>
                        <li><a href="list.php">List</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="portfolio.php"><i class='bx bx-folder'></i>Portfolio</a>
                </li>
                <li><a href="archives.php"><i class='bx bx-archive'></i>Archives</a></li>
                <li><a href="#" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a></li>
            </ul>
        </nav>
    </aside>

    <script>
    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to logout?");
        if (confirmLogout) {
            window.location.href = "logout.php"; // Redirect to logout page
        }
    }

    function toggleSidebar() {
        var sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("collapsed");
    }
    </script>
</body>

</html>