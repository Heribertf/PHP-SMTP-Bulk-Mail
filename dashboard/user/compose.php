<?php
include_once "./includes/header.php";
?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Compose Email
    </h2>
    <div class="col-md-12 flex justify-center">
        <div class=" col-md-6 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">

            <h6 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Compose New Email
            </h6>

            <div id="loader">
                <div class="loader"></div>
            </div>

            <form class="forms-sample" enctype="multipart/form-data" method="post" id="mail-form">
                <div class="mb-3">
                    <label for="" class="form-label block mt-4 text-sm fw-500">Your Email
                        Address:</label>
                    <input
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="email" id="sender_email" name="sender_email" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label block mt-4 text-sm fw-500">App Password (For the above
                        email address from
                        Gmail. <strong>Do Not Include Spaces.</strong>):<br>
                        <a class="flex items-center justify-between p-2 mb-2 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                            href="https://www.getmailbird.com/gmail-app-password/" target="_blank">
                            <div class="flex items-center">
                                <span>Click here on how to generate app password from gmail</span>
                            </div>
                            <span>View Guide &RightArrow;</span>
                        </a></label>
                    <input
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="password" id="app_password" name="app_password" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label block mt-4 text-sm fw-500">Your Name (As it will appear on the
                        email):</label>
                    <input
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="text" id="sender_name" name="sender_name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label block mt-4 text-sm fw-500">Recipient
                        Emails
                        (Email addresses separated by commas):
                    </label>
                    <textarea
                        class="form-control block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        id="recipient_emails" name="recipient_emails" rows="3" maxlength=""
                        placeholder="Enter recipient emails here separated by commas"></textarea>
                </div>
                <div class="mb-3 mt-4">
                    <small class="text-xs text-gray-500">Or upload a CSV/Excel file containing only recipient email
                        addresses. Ensure that the emails are in the first column.</small>
                    <label for="email_list" class="form-label block text-sm fw-500">Recipient Email List (CSV/Excel
                        file):</label>
                    <input type="file"
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        id="email_list" name="email_list">

                </div>
                <div class="mb-3">
                    <label for="" class="form-label block mt-4 text-sm fw-500">Email Subject:</label>
                    <input
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="text" id="email_subject" name="email_subject" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1"
                        class="form-label block mt-4 text-sm fw-500">Message</label>
                    <textarea
                        class="form-control block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        id="email_body" name="email_body" rows="6" maxlength="" placeholder="Write your Message here..."
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="attachments" class="form-label block mt-4 text-sm fw-500">Attachments
                        (Optional):</label>
                    <input type="file"
                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        id="attachments" name="attachments[]" multiple>
                    <small class="text-xs text-gray-500">You can select multiple files by pressing CTRL or CMD</small>
                </div>
                <button type="submit" name="submit" value="submit"
                    class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Send</button>
            </form>
        </div>
    </div>
    <!-- <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="col-md-6 grid-margin stretch-card" id="first-form">

                            <h6 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                                Compose New Email
                            </h6>

                            <form class="forms-sample" enctype="multipart/form-data" method="post" id="package-form">
                                <div class="mb-3">
                                    <label for="" class="form-label block mt-4 text-sm fw-500">Your Email
                                        Address:</label>
                                    <input
                                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="package_name" name="package_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label block mt-4 text-sm">App Password (From
                                        gmail - recommended. For non-gmail emails use your email password):<br>
                                        <a class="flex items-center justify-between p-2 mb-2 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                                            href="https://github.com/estevanmaito/windmill-dashboard">
                                            <div class="flex items-center">
                                                <span>Click here on how to generate app password from gmail</span>
                                            </div>
                                            <span>View Tutorial &RightArrow;</span>
                                        </a></label>
                                    <input
                                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="number" id="package_price" name="package_price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label block mt-4 text-sm">Recipient Emails
                                        (Email addresses separated by line breaks or commas):
                                    </label>
                                    <textarea
                                        class="form-control block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        id="package_desc" name="package_desc" rows="5" maxlength=""
                                        placeholder="Enter recipient emails here separated by commas"></textarea>
                                    <label for="exampleFormControlTextarea1" class="form-label block mt-4 text-sm">Or
                                        upload a CSV file containing emails
                                        instead: <input type="file" class="form-control mt-4" name="image_file"
                                            id="image_file">
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label block mt-4 text-sm">Email Subject:</label>
                                    <input
                                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="package_name" name="package_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label block mt-4 text-sm">Message</label>
                                    <textarea
                                        class="form-control block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        id="package_desc" name="package_desc" rows="8" maxlength=""
                                        placeholder="Write your Message here..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="package_status" class="form-label block mt-4 text-sm">
                                        Schedule for later:
                                    </label>
                                    <input
                                        class="form-control block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="date" id="package_price" name="package_price" required>
                                </div>
                                <button type="submit" name="submit" value="submit"
                                    class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Send</button>
                            </form>
                        </div>
                    </div> -->

</div>
<?php
include_once "./includes/footer.php";
?>

<script>
    $(document).ready(function () {
        $('#mail-form').submit(function (e) {
            e.preventDefault();

            var loader = document.getElementById("loader");
            loader.style.display = "block";

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: './send_email',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        loader.style.display = "none";
                        Toastify({
                            text: response.message,
                            //duration: 5000,
                            close: true,
                            position: "center",
                            gravity: "top",
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)"
                            },
                            //backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Green for success
                            // className: "toastify-success",
                            //stopOnFocus: true
                        }).showToast();
                        setTimeout(function () {
                            location.reload();
                        }, 5200);
                    } else {
                        loader.style.display = "none";
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            position: "center",
                            gravity: "top",
                            style: {
                                background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                            },
                            // backgroundColor: "linear-gradient(to right, #ff416c, #ff4b2b)", // Red for error
                            // className: "toastify-error",
                            stopOnFocus: true
                        }).showToast();
                    }
                },
                error: function (xhr, status, error) {
                    loader.style.display = "none";
                    Toastify({
                        text: "An unexpected error occurred",
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
                        //backgroundColor: "linear-gradient(to right, #ff416c, #ff4b2b)", // Red for error
                        // className: "toastify-error",
                        stopOnFocus: true
                    }).showToast();
                }
            });
        });
    });

</script>
<?php
include_once "./includes/footer-end.php";
?>