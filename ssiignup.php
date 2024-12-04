<?php session_start();
if (isset($_SESSION['captcha'])) {
    unset($_SESSION['captcha']);
}
$login_page = 'yes';
$uri = $_SERVER['REQUEST_URI'];
// Check if the URL contains any uppercase letters
if (preg_match('/[A-Z]/', $uri)) {
    // Convert the URL to lowercase
    $lowercaseUri = strtolower($uri);

    // Perform a 301 redirect to the lowercase URL
    header("Location: $lowercaseUri", true, 301);
    exit;
}
include './routes.php';
include './backend/cradential.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/signup.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Signup - skokra</title>
    <style>
        .grey_btn {
            background-image: none;
            background-color: lightgrey;
        }

        .grey_btn:hover {
            background-color: lightgrey;
        }

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
                <h1 style="font-weight: bolder;">JOIN SKOKRA</h1>
                <h2>Publish and Manage your ads</h2>
                <form id="signupnotrequired" action="<?=get_url() ?>signup" method="post">
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
                    <div class="password-check" id="password-check">
                        <ul>
                            <li id="lowercharacter"><i class="ri-checkbox-circle-fill" id="right"></i> a lowercase letter</li>
                            <li id="uppercharacter"><i class="ri-checkbox-circle-fill" id="right"></i> a uppercase letter</li>
                            <li id="a-number"><i class="ri-checkbox-circle-fill" id="right"></i> a number</li>
                            <li id="8-character"><i class="ri-checkbox-circle-fill" id="right"></i> Minimum 8 Characters</li>
                        </ul>
                    </div>
                    <div class="form-group form-row">
                        <input type="checkbox" name="confirm" value="true" id="confirm">
                        <p><b>Terms, Conditions and Privacy Policy</b><br>
                            I have read the <a href="">Terms and Conditions</a> of use and <a href="">Privacy Policy</a> and I hereby authorize the processing of my personal data for the purpose of providing this web service.</p>
                    </div>
                    <div class="form-group form-row">
                        <div class="captcha">
                            <img src="./assets/images/stripes-pattern-11551057021pkmmog3xef.png" alt="">
                            <div class="hide-the-captcha"></div>
                        </div>
                        <div>
                            <input type="text" name="captcha-txt" maxlength="6" required placeholder="Enter Captcha" id="captcha">
                            <p style="padding: 0;margin:0" id="captcha-error"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="grey_btn signup-btn" id="submit" name="submit" disabled>SIGN UP</button>
                    </div>
                </form>
                <p style="text-align: center;padding-top:5%;border-top:1px solid lightgrey">Already Have An Account? <a href="<?=get_url() ?>login">Login</a></p>
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
        document.getElementById('password').addEventListener('keyup', (e) => {
            let password = e.target.value;
            var _character = document.getElementById('8-character')
            var lowercharacter = document.getElementById('lowercharacter')
            var uppercharacter = document.getElementById('uppercharacter')
            var number = document.getElementById('a-number')
            // 8 character
            if (password.length >= 8) {
                _character.style.color = 'green'
            } else {
                _character.style.color = 'grey'
            }

            function checkTextCharacterTypes(text) {
                const containsLowercase = /[a-z]/.test(text);
                const containsUppercase = /[A-Z]/.test(text);
                const containsNumber = /\d/.test(text);

                if (containsLowercase) {
                    lowercharacter.style.color = 'green'
                } else {
                    lowercharacter.style.color = 'grey'
                }
                if (containsUppercase) {
                    uppercharacter.style.color = 'green'
                } else {
                    uppercharacter.style.color = 'grey'
                }
                if (containsNumber) {
                    number.style.color = 'green'
                } else {
                    number.style.color = 'grey'
                }
            }
            checkTextCharacterTypes(password);
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
                        document.getElementById('submit').classList.remove('grey_btn')
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

    <?php

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $terms = $_POST['confirm'];
        $result = json_decode(User_Signup::Signup($email, $password, $terms), true);
        if ($result['msg'] == 'exist') { 
            $errormessage = 'Username Already exist';
        } elseif ($result['msg'] == 'success') { $_SESSION['email'] = $email;          
            $_SESSION['last_activity'] = time(); ?> <script>window.location.href = "<?=get_url() ?>verification"; </script> <?php } else { 
            $errormessage = 'Provided Password is Incorrect';
        }
    }

    if(isset($errormessage)){ ?>
        <script>
        document.getElementById('showerror').innerText = '<?=$errormessage ?>';
        document.getElementById('showerror').style.backgroundColor = 'tomato';
        document.getElementById('showerror').style.right = '0px';
        setTimeout(() => {
            document.getElementById('showerror').style.right = '-310px';
        }, 5000)
    </script>
   <?php }

    ?>
</body>

</html>