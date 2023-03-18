<?php
$loginPressed = filter_input(INPUT_POST, 'btnLogin');
if (isset($loginPressed)) {
    $email = filter_input(INPUT_POST, 'txtEmail');
    $password = filter_input(INPUT_POST, 'txtPassword');
    if (trim($email) == '' || trim($password) == '') {
        echo '<div>Please input your email and password</div>';
    } else {
        $user = login($email, $password);
        if ($user['email'] == $email){
            $_SESSION['registered_user'] = true;
            $_SESSION['registered_name'] = $user['name'];
            header('location:index.php');
        } else {
            echo '<div>Invalid email or password</div>';
        }
    }
}
?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="txtEmail" name="txtEmail" class="form-control form-control-lg" />
                                    <label class="form-label" for="txtEmail">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="txtPassword" name="txtPassword" class="form-control form-control-lg" />
                                    <label class="form-label" for="txtPassword">Password</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btnLogin">Login</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>