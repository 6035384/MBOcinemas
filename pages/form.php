<?php include '../components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Log in of registreer je bij MBOcinemas en geniet van de beste films in de leukste bioscoop van Nederland!">
    <meta name="keywords" content="cinemas, login, registratie, films, theater">
    <meta name="author" content="Maryam Aldainy">
    <link rel="stylesheet" href="../css/style.css">
    <title>MBOcinemas - Login / Registratie</title>
</head>
<body>
    <nav class="main-nav">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-links">
                <a href="#"><i class="fa-solid fa-user-large"></i> <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <a href="logOutForm.php"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
            </div>
        <?php else: ?>
            <a href="form.php"><i class="fa-solid fa-right-to-bracket"></i> Log in</a>
        <?php endif; ?>
    </nav>

    <main class="form-container">
        <!-- Login Box -->
        <div class="form-box">
            <h2>Login</h2>
            <form method="POST" action="../registerLogin/login.php">
                <input type="text" name="name" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="form-options">
                    <label>
                        <input type="checkbox" onclick="seePassword()"> Show Password
                    </label>
                    <a href="forgotPw.php" class="forgot-password">Forgot Password?</a>
                </div>
                <button class="button"><span>Login</span></button>
            </form>
        </div>

        <!-- Registratie Box -->
        <div class="form-box">
            <h2>Sign Up</h2>
            <form method="POST" action="../registerLogin/signup.php">
                <input type="text" name="name" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" placeholder="Confirm Password" required>
                <div class="form-options">
                    <label>
                        <input type="checkbox" onclick="seePassword()"> Show Password
                    </label>
                </div>
                <button class="button"><span>Sign Up</span></button>
            </form>
        </div>
    </main>

    <footer>
        <?php include '../components/footer.php'; ?>
    </footer>
</body>
</html>
