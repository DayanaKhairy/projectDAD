<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar</title>
    <style>
    body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
    }

    #sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: -250px;
        background-color: #456ba0;
        padding-top: 20px;
        transition: 0.5s;
    }

    #sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 18px;
        color: #fff;
        display: block;
        transition: 0.3s;
    }

    #sidebar a:hover {
        background-color: #314d78;
    }

    #content {
        margin-left: 0;
        transition: margin-left 0.5s;
        padding: 16px;
    }

    #menu-btn {
        font-size: 24px;
        cursor: pointer;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 2;
        color: #fff;
    }
    </style>
</head>

<body>

    <div id="sidebar">
        <a href="#" onclick="toggleSidebar()">Item 1</a>
        <a href="#" onclick="toggleSidebar()">Item 2</a>
        <a href="#" onclick="toggleSidebar()">Item 3</a>
        <!-- Add more items as needed -->
    </div>

    <div id="content">
        <div id="menu-btn">&#9776; Menu</div>
        <h1>Main Content</h1>
        <p>This is the main content area.</p>
    </div>

    <script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        var menuBtn = document.getElementById('menu-btn');

        if (sidebar.style.left === "0px") {
            sidebar.style.left = "-250px";
            content.style.marginLeft = "0";
            menuBtn.innerHTML = "&#9776; Menu";
        } else {
            sidebar.style.left = "0";
            content.style.marginLeft = "250px";
            menuBtn.innerHTML = "&times; Close";
        }
    }
    </script>
</body>

</html>