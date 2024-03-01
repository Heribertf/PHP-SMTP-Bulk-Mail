<?php include_once "./includes/header-auth.php"; ?>

<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                    src="./assets/img/forgot-password-office.jpeg" alt="Office" />
                <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                    src="./assets/img/forgot-password-office-dark.jpeg" alt="Office" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Password Reset
                    </h1>

                    <div id="loader">
                        <div class="loader"></div>
                    </div>

                    <?php
                    if ($_GET['email'] && $_GET['token']) {
                        require_once './includes/config.php';
                        require_once './includes/mysqli_connection.php';

                        $email = $_GET['email'];
                        $token = $_GET['token'];
                        $curDate = date("Y-m-d H:i:s");
                        $query = "SELECT user_id, email, token, token_expiry FROM users WHERE email = ? AND token = ?";

                        if ($stmt = mysqli_prepare($conn, $query)) {
                            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_token);
                            $param_email = $email;
                            $param_token = $token;

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 1) {
                                mysqli_stmt_bind_result($stmt, $user_id, $user_email, $user_token, $token_expiry);
                                if (mysqli_stmt_fetch($stmt)) {
                                    if ($token_expiry >= $curDate) { ?>
                                        <form action="" method="post" enctype="multipart/form-data" id="pass-reset-form">
                                            <div class="">
                                                <input type="hidden" name="email" value="<?php echo $email; ?>" readonly>
                                                <input type="hidden" name="reset-link-token" value="<?php echo $token; ?>" readonly>
                                            </div>
                                            <label class="block text-sm">
                                                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                                                <input
                                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                    placeholder="Type your password" type="password" id="new-password" name="new-password"
                                                    required />
                                            </label>
                                            <label class="block mt-4 text-sm">
                                                <span class="text-gray-700 dark:text-gray-400">
                                                    Confirm New Password
                                                </span>
                                                <input
                                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                    placeholder="Confirm your password" type="password" id="confirm-new-password"
                                                    name="confirm-new-password" required />
                                            </label>

                                            <button
                                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                                type="submit" name="submit" value="submit">
                                                Reset password
                                            </button>
                                        </form>
                                    <?php } else { ?>
                                        <div class="custom-warning-card">
                                            <div class="custom-card">
                                                <div class="custom-card-header">Warning</div>
                                                <div class="card-body">
                                                    <h5 class="custom-card-title">Wrong Reset Link</h5>
                                                    <p class="custom-card-text">
                                                        It seems that the above link is invalid. You can always request for a new one.
                                                    </p>
                                                    <a href="./login" class="custom-button"><button>LOGIN</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            } else { ?>
                                <div class="custom-warning-card">
                                    <div class="custom-card">
                                        <div class="custom-card-header">Warning</div>
                                        <div class="card-body">
                                            <h5 class="custom-card-title">Wrong Reset Link</h5>
                                            <p class="custom-card-text">
                                                It seems that the above link is invalid. You can always request for a new one.
                                            </p>
                                            <a href="./login" class="custom-button"><button>LOGIN</button></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                    } else { ?>
                        <div class="custom-warning-card">
                            <div class="custom-card">
                                <div class="custom-card-header">Warning</div>
                                <div class="card-body">
                                    <h5 class="custom-card-title">Wrong Reset Link</h5>
                                    <p class="custom-card-text">
                                        It seems that the above link is invalid. You can always request for a new one.
                                    </p>
                                    <a href="./login" class="custom-button"><button>LOGIN</button></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "./includes/footer-auth.php"; ?>
<?php include_once "./includes/footer-auth-end.php"; ?>