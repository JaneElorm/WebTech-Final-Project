<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="../css/register.css">
</head>

<div class="main">
    <form action="../actions/register_user_action.php" method="post" name="registration_form" id="registration_form">
        <div class="half">
            <h1>Register</h1>

            <label for="first">First Name:</label>
            <input type="text" id="first" name="first" placeholder="Enter your first name" required>

            <label for="last">Last Name:</label>
            <input type="text" id="last" name="last" placeholder="Enter your last name" required>

            <label for="gender">Gender:</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" placeholder="Enter your DOB" required>
        </div>

        <div class="half">
            <label for="mobile">Contact:</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile Number" required maxlength="10">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" required title="Password must contain at least one number, one alphabet, one symbol, and be at least 8 characters long">

            <label for="repassword">Re-type Password:</label>
            <input type="password" id="repassword" name="repassword" placeholder="Re-Enter your password" required>
            <span id="pass"></span>

            <div class="wrap">
                <button type="submit" name="submit">Submit</button>
            </div>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>

    </form>
</div>


<script>
    // script.js 

    function solve() {
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
                'Password must be at least 8 characters' +
                ' long and include at least one number,' +
                ' one alphabet, and one symbol.';
            setTimeout(() => {
                pass.innerText = "";
            }, 3000);
        }
        if (flag)
            alert("Form submitted");
    }
</script>

</body>

</html>