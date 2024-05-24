<?php
session_start();
if (isset($_SESSION['loggedInStatus'])) {
    header('Location: first.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form in PHP MySQL with Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card card-body shadow mt-4">
                <h4 class="text-center">Register</h4>
                <hr>
                <form action="register-code.php" method="POST" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" class="form-control" required />
                        <div id="nameFeedback" class="invalid-feedback">
                            Please provide your name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" class="form-control" required />
                        <div id="phoneFeedback" class="invalid-feedback">
                            Please provide your phone number.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required />
                        <div id="emailFeedback" class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required />
                        <div id="passwordFeedback" class="invalid-feedback">
                            Please provide a password.
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="registerBtn" class="btn btn-primary w-100">Submit</button>
                    </div>
                    <div class="text-center">
                        <a href="login.php">Click here to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlIW2Y3YRm+yKJwSAwy4XNR7f2w7/z9j7sKeEKOtu6+s5tZT4IuJ9g9g8p5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        function validateForm() {
            let name = document.getElementById('name');
            let phone = document.getElementById('phone');
            let email = document.getElementById('email');
            let password = document.getElementById('password');
            let valid = true;

            if (!name.value) {
                name.classList.add('is-invalid');
                valid = false;
            } else {
                name.classList.remove('is-invalid');
            }

            if (!phone.value) {
                phone.classList.add('is-invalid');
                valid = false;
            } else {
                phone.classList.remove('is-invalid');
            }

            if (!email.value) {
                email.classList.add('is-invalid');
                valid = false;
            } else {
                email.classList.remove('is-invalid');
            }

            if (!password.value) {
                password.classList.add('is-invalid');
                valid = false;
            } else {
                password.classList.remove('is-invalid');
            }

            return valid;
        }
    </script>
</body>
</html>
