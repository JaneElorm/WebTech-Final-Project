<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="login-form">
                <h1>Login</h1>
                <form action="../actions/login_user_action.php" method="POST" id="login-form" onsubmit="return solve()">
                    <div class="form-group">
                        <p>Username:</p>
                        <input type="text" id="email" name="email" class="form-control" required placeholder="Enter registered email">
                        <p id="email-error" style="color: red;"></p>
                    </div>
                    <div class="form-group">
                        <p>Password:</p>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="Enter password">
                        <p id="password-error" style="color: red;"></p>
                    </div>
                    <button type="submit" class="btn-primary" name="Login">Login</button>
                </form>
                <p id="login-error" class="error-message" style="color: red;"></p>
            
            </div>

        </div>
        <div class="additional-links">
            <p class="register-link">New User? <a href="register.php">Register new account</a></p>
            
        </div>
    </section>
    <script src="../js/login.js"></script>
    <script>     function solve() { 
            let password = 
                document.getElementById('password').value; 
            let repassword = 
                document.getElementById('repassword').value; 
            let mobile = 
                document.getElementById('mobile').value; 
            let mail = 
                document.getElementById('email').value; 
            let flag = 1; 
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        
            if (!emailRegex.test(mail)) { 
                flag = 0; 
                pass.innerText = 
                    'Please enter a valid email address.'; 
                setTimeout(() => { 
                    pass.innerText = ""; 
                }, 3000); 
            } 
        
            if (password !== repassword) { 
                flag = 0; 
                pass.innerText = 
                    "Passwords do not match. Please re-enter."; 
                setTimeout(() => { 
                    pass.innerText = ""; 
                }, 3000); 
            } 
    
            let passwordRegex = 
                /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$/; 
        
            if (!passwordRegex.test(password)) { 
                flag = 0; 
                pass.innerText = 
                    'Password must be at least 8 characters'+ 
                    ' long and include at least one number,'+ 
                    ' one alphabet, and one symbol.'; 
                setTimeout(() => { 
                    pass.innerText = ""; 
                }, 3000); 
            } 
            if (flag) 
                alert("Form submitted"); 
        }
        ipt>
        function validateLogin() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (username.trim() === '' || password.trim() === '') {
                alert('Please enter both username and password.');
                return false;
            }
            return true;
        }
        </script>
</body>

</html>