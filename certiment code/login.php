<!DOCTYPE html>
<html lang="en">
<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'certimentdb');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['email'];
    $user_pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, user_email, user_Fname, user_Lname, user_pass, user_pic, user_type, user_phoneNo, total_Doc, user_grade FROM 
    user WHERE user_email =?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    
        if (password_verify($user_pass, $row['user_pass'])) {
            // Set session variables
            //$_SESSION['user_id'] = $row['user_id'];
            session_start();
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_name'] = $row['user_Fname'] . ' ' . $row['user_Lname'];
            $_SESSION['user_type'] = $row['user_type'];
    
            // Add the following line to store the user's email in the session
            $_SESSION['email'] = $row['user_email'];
                // Redirect based on user type
            if ($row['user_type'] === 'employer') {
                echo '<script>
                    if (confirm("Login Successful. Welcome, ' . $row['user_Fname'] . '! Click OK to continue.")) {
                        window.location.href = "employer.php";
                    } else {
                        window.location.reload();
                    }
                  </script>';
            } else {
                echo '<script>
                    if (confirm("Login Successful. Welcome, ' . $row['user_Fname'] . '! Click OK to continue.")) {
                        window.location.href = "home.php";
                    } else {
                        window.location.reload();
                    }
                  </script>';
            }
            exit();
        } else {
            echo '<script>
                    if (confirm("Invalid Password. Click OK to try again.")) {
                        window.location.href = "login.php";
                    } else {
                        window.location.href = "login.php";
                    }
                  </script>';
        }
    } else {
        echo '<script>
                if (confirm("User Not Found. Click OK to try again.")) {
                    window.location.href = "login.php";
                } else {
                    window.location.href = "login.php";
                }
              </script>';
    }
    $stmt->close();
}
$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        background-color: #354B97
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url(bg.png);
        background-size: cover;
        background-position: center;
    }

    .wrapper .form-box {
        width: 450px;
        height: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .form-input-box {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .form-input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .form-input-box input::placeholder {
        color: #fff;
    }

    .form-input-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .wrapper .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;

    }

    .remember-forgot label input {
        accent-color: #fff;
        margin-right: none;
    }

    .remeber-forgot a {
        color: #fff;
        text-decoration: none;
    }

    .remeber-forgot a:hover {
        text-decoration: underline;
    }

    .wrapper .btn {
        width: 100%;
        height: 40px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;
    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }

    .wrapper .reg-form-box {
        width: 450px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 30px;
    }

    .wrapper .reg-input-box {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .reg-input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .reg-input-box input::placeholder {
        color: #fff;
    }

    .wrapper .drop-down {
        width: 100%;
        height: 50px;
        margin: 30px 0;
        position: relative;
        justify-content: space-between;
    }

    .drop-down option {
        font-size: 16px;
    }

    .drop-down select {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .drop-down input {
        width: 100%;
        height: 100%;
        position: absolute;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 30px;
    }

    .drop.down input::placeholder {
        color: #fff;
    }

    .drop-down option {
        background-color: transparent;
        color: black;
    }
    </style>
    <title>Login Certiment</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <div class="wrapper">
        <form id="loginForm" action="login.php" method="post">
            <div class="form-box login">
                <h1>Login</h1>
                <div class="form-input-box">
                    <input type="text" id="emailInput" name="email" placeholder="email" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="form-input-box">
                    <input type="password" id="passwordInput" name="password" placeholder="password" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>

                <script>
                function redirectToNextPage() {

                    var email = document.getElementById('emailInput').value;
                    var password = document.getElementById('passwordInput').value;


                    if (email.trim() === '' || password.trim() === '') {
                        alert('Please fill in all required fields');
                    } else {

                        window.location.replace("home.php");
                    }
                }
                </script>
                </a>
                <div class="register-link">
                    <p>Don't have an account?<a href="register.php">Register</a></p>
                </div>
            </div>
        </form>
    </div>

</body>

</html>

</html>