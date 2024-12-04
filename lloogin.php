<?php session_start();
if (isset($_SESSION['captcha'])) {
    unset($_SESSION['captcha']);
}
$uri = $_SERVER['REQUEST_URI'];
// Check if the URL contains any uppercase letters
if (preg_match('/[A-Z]/', $uri)) {
    // Convert the URL to lowercase
    $lowercaseUri = strtolower($uri);

    // Perform a 301 redirect to the lowercase URL
    header("Location: $lowercaseUri", true, 301);
    exit;
}
$login_page = 'yes';
if (isset($_GET['next'])) {
    $_SESSION['url'] = $_GET['next'];
}
include './routes.php';
include './backend/cradential.php';

?>
    <?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = json_decode(User_Signup::Login($email, $password), true);
    if ($result['msg'] == 'exist') {
        $errorMessage = "Either Username is incorrect or username does not exist";
        $errorColor = "tomato";
    } elseif ($result['msg'] == 'success') {
        $_SESSION['email'] = $email;
        $_SESSION['last_activity'] = time();
        if (isset($_SESSION['url'])) { ?>
            <script>
                window.location.href = "<?= $_SESSION['url'] ?>";
            </script>
        <?php } else { ?>
            <script>
                window.location.href = "u/account/dashboard";
            </script>
<?php
        }
    } else {
        $errorMessage = "Provided Password is Incorrect";
        $errorColor = "tomato";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/signup.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Login - skokra</title>
    <style>
        .showerror {
            width: 300px;
            min-height: 50px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            box-shadow: 0 0 6px 3px lightgrey;
            padding: 2%;
            position: fixed;
            top: 20%;
            right: -310px;
            color: white;
            transition: right 1s;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <a href="<?= get_url() ?>" class="logo"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" alt=""></a>
        </header>
        <div class="form-container">
            <div class="form-body">
                <h1 style="font-weight: bolder;">GET INTO SKOKRA</h1>
                <h2>Publish and Manage your ads</h2>
                <form id="signupnotrequired" action="<?= get_url() ?>login" method="post">
                    <div class="form-group">
                        <label for="emal">Email</label><span id="email-error" style="color: tomato;display:none;font-size:small">email is required</span><br>
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><span id="password-error" style="color: tomato;display:none;font-size:small">password is required</span><br>
                        <div class="password-show">
                            <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                            <div id="hide-pass" class="active"><i class="ri-eye-off-fill"></i></div>
                            <div id="show-pass"><i class="ri-eye-fill"></i></div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="captcha">
                            <img src="<?= get_url() ?>assets/images/stripes-pattern-11551057021pkmmog3xef.png" alt="">
                            <div class="hide-the-captcha"></div>
                        </div>
                        <div>
                            <input type="text" name="captcha-txt" maxlength="6" required placeholder="Enter Captcha" id="captcha">
                            <p style="padding: 0;margin:0" id="captcha-error"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="signup-btn" id="submit" name="submit" disabled>SIGN IN</button>
                    </div>
                </form>
                <p style="text-align: center;padding-top:5%;border-top:1px solid lightgrey">Don't Have An Account Yet? <a href="<?=get_url() ?>signup">Signup</a></p>
            </div>
        </div>
    </div>
    <div class="showerror" id="showerror"></div>
    <?php include './footer.php' ?>

    <script>
        document.getElementById('signupnotrequired').addEventListener('submit', (e) => {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            if (email.trim().length == 0) {
                document.getElementById('email-error').style.display = 'inline-block';
                e.preventDefault()
            } else {
                document.getElementById('email-error').style.display = 'none';
            }
            if (password.trim().length == 0) {
                document.getElementById('password-error').style.display = 'inline-block';
                e.preventDefault()
            } else {
                document.getElementById('password-error').style.display = 'none';
            }
        })
        document.getElementById('captcha').addEventListener('keyup', (e) => {
            var captcha_code = e.target.value;
            const data = new FormData();
            data.append('captcha', captcha_code)
            fetch('<?= get_url() ?>google/em/recaptcha/', {
                    method: 'post',
                    body: data
                }).then(res => res.json())
                .then(d => {
                    if (d['status'] == 'ok') {
                        var notAuthenticatedAction = d['notauthenticated'];

                        // Set the 'action' attribute for the element with ID 'signupnotrequired'
                        // document.getElementById('signupnotrequired').setAttribute('action', notAuthenticatedAction);

                        // Set the 'readonly' attribute for the element with ID 'captcha'
                        document.getElementById('captcha').setAttribute('readonly', true);

                        // Enable the 'submit' button by removing the 'disabled' attribute
                        document.getElementById('submit').removeAttribute('disabled');
                        document.getElementById('captcha-error').style.color = 'green'
                        document.getElementById('captcha-error').innerHTML = '<i class="ri-checkbox-circle-fill"></i> Captcha Verified'
                    } else {
                        document.getElementById('captcha-error').style.color = 'tomato'
                        document.getElementById('captcha-error').innerHTML = '<i class="ri-close-circle-fill"></i> Captcha does not match';
                        if (captcha_code.length <= 0 || captcha_code == '' || captcha_code == null) {
                            document.getElementById('captcha-error').innerHTML = ''
                        }
                    }
                })

        })

        <?php
        function generateAlphanumericNumber($length = 6)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $randomString;
        }

        // Example usage:
        $alphanumericNumber = generateAlphanumericNumber();
        $_SESSION['captcha'] = $alphanumericNumber;

        ?>
        document.querySelector('.hide-the-captcha').innerHTML = '<b><?= $alphanumericNumber ?></b>';

        document.getElementById('password').addEventListener('focus', function() {
            document.querySelector('.password-show').classList.add('focus');
        });

        document.getElementById('password').addEventListener('blur', function() {
            document.querySelector('.password-show').classList.remove('focus');
        });


        document.getElementById('hide-pass').addEventListener('click', () => {
            const passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                document.getElementById("hide-pass").style.display = "none"
                document.getElementById("show-pass").style.display = "block"
            }
        })
        document.getElementById('show-pass').addEventListener('click', () => {
            const passwordField = document.getElementById('password');
            if (passwordField.type === "text") {
                passwordField.type = "password";
                document.getElementById("hide-pass").style.display = "block"
                document.getElementById("show-pass").style.display = "none"
            }
        })
    </script>


    <?php if (isset($errorMessage)) : ?>
        <script>
            document.getElementById('showerror').innerText = '<?php echo $errorMessage; ?>';
            document.getElementById('showerror').style.backgroundColor = '<?php echo $errorColor; ?>';
            document.getElementById('showerror').style.right = '0px';
            setTimeout(() => {
                document.getElementById('showerror').style.right = '-310px';
            }, 5000)
        </script>
    <?php endif; ?>


    <?php

    // Example usage:
    // $customerCode = generateCustomerCode($email);
    // echo "Customer code: $customerCode";



    ?>
</body>

</html>