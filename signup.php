<?php session_start();
if (isset($_SESSION['captcha'])) {
    unset($_SESSION['captcha']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="stylesheet" href="./assets/css/footer.css" defer>
    <title>Signup - skokra</title>
</head>

<body>
    <div class="container">
        <header>
            <a href="" class="logo"><img src="./assets/images/SKOKRA+LOGO+NEW+(2).webp.png" alt=""></a>
        </header>
        <div class="form-container">
            <div class="form-body">
                <h1 style="font-weight: bolder;">JOIN SKOKRA</h1>
                <h2>Publish and Manage your ads</h2>
                <form id="signupnotrequired" method="post">
                    <div class="form-group">
                        <label for="emal">Email</label><br>
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><br>
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
                        <input type="checkbox" name="confirm" id="confirm">
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
                        <button class="signup-btn" id="submit" disabled>SIGN UP</button>
                    </div>
                </form>
                <p style="text-align: center;padding-top:5%;border-top:1px solid lightgrey">Already Have An Account? <a href="login">Login</a></p>
            </div>
        </div>



    </div>
    <?php include './footer.php' ?>

    <script>
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
            fetch('google/em/recaptcha', {
                    method: 'post',
                    body: data
                }).then(res => res.json())
                .then(d => {
                    if (d['status'] == 'ok') {
                        var notAuthenticatedAction = d['notauthenticated'];

                        // Set the 'action' attribute for the element with ID 'signupnotrequired'
                        document.getElementById('signupnotrequired').setAttribute('action', notAuthenticatedAction);

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
        document.getElementById('hide-pass').addEventListener('click',()=>{
            const passwordField = document.getElementById('password');
            if(passwordField.type === "password"){
                passwordField.type = "text";
                document.getElementById("hide-pass").style.display="none"
                document.getElementById("show-pass").style.display="block"
                }
        })
        document.getElementById('show-pass').addEventListener('click',()=>{
            const passwordField = document.getElementById('password');
            if(passwordField.type === "text"){
                passwordField.type = "password";
                document.getElementById("hide-pass").style.display="block"
                document.getElementById("show-pass").style.display="none"
                }
        })
    </script>
</body>

</html>