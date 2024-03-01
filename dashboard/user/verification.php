<?php
include_once "./includes/header-auth.php";
?>
<?php
if (isset($_GET["email"])) {
    $user_email = $_GET["email"];
}
?>
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                    src="./assets/img/login-office.jpeg" alt="Office" />
                <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                    src="./assets/img/login-office-dark.jpeg" alt="Office" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Email Verification
                    </h1>
                    <div id="loader">
                        <div class="loader"></div>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="verify-form">
                        <label class="block text-sm">
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="" type="hidden" id="email" name="email"
                                value="<?php echo htmlspecialchars($user_email); ?>" required readonly />
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Verification Code</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="" type="text" id="code" name="code" required />
                        </label>

                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            type="submit" name="submit" value="submit">
                            Submit
                        </button>
                    </form>

                    <hr class="my-8" />

                    <p class="mt-4">
                        <a class="resend text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                            href="#" dataEmailId="<?php echo htmlspecialchars($user_email); ?>">
                            Resend Code?
                        </a>
                    </p>
                    <p class="mt-1">
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                            href="./login">
                            Back to Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "./includes/footer-auth.php"; ?>
<?php include_once "./includes/footer-auth-end.php"; ?>