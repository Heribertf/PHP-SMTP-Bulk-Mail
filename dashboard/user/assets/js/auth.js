$(document).ready(function () {
    $('#reg-form').submit(function (e) {
        e.preventDefault();

        // Perform password strength check
        var password = $('#password').val();
        if (!isPasswordStrong(password)) {
            Toastify({
                text: 'Password should be at least 8 characters long and contain a combination of uppercase, lowercase, and numbers.',
                duration: 5000,
                close: true,
                position: "center",
                gravity: "top",
                style: {
                    background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                },
                stopOnFocus: true
            }).showToast();
            return;
        }

        // Continue with form submission if password is strong
        // $('#my-loader').show();
        var loader = document.getElementById("loader");
        loader.style.display = "block";

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: './register-check',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                loader.style.display = "none";
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 5000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)"
                        },
                        // className: "toastify-success",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        if (response.email) {
                            window.location.href = "./verification.php?email=" +
                                response.email;
                        } else {
                            window.location.href = "./login";
                        }
                    }, 5200);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
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
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    function isPasswordStrong(password) {
        // Password should be at least 8 characters long and contain a combination of uppercase, lowercase, and numbers.
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
        return strongRegex.test(password);
    }


    $('#login-form').submit(function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: './login-check',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.location.href = "./home";
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
                        // className: "toastify-error",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        if (response.redirect && response.email) {
                            window.location.href = "./verification.php?email=" + response.email;
                        }
                    }, 3200);
                }
            },
            error: function (xhr, status, error) {
                // console.log(xhr);
                Toastify({
                    text: "An unexpected error occurred",
                    duration: 3000,
                    close: true,
                    position: "center",
                    gravity: "top",
                    style: {
                        background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                    },
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    $('#verify-form').submit(function (e) {
        e.preventDefault();

        var loader = document.getElementById("loader");
        loader.style.display = "block";

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: './code-check',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                loader.style.display = "none";
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)"
                        },
                        // className: "toastify-success",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = "./login";
                    }, 3200);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
                        // className: "toastify-error",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        if (response.redirect) {
                            window.location.href = "./login";
                        }
                    }, 3200);
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                // console.log(xhr);
                Toastify({
                    text: "An unexpected error occurred",
                    duration: 3000,
                    close: true,
                    position: "center",
                    gravity: "top",
                    style: {
                        background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                    },
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    $('.resend').on('click', function (e) {
        e.preventDefault();

        var loader = document.getElementById("loader");
        loader.style.display = "block";

        const userEmail = this.getAttribute('dataEmailId');
        $.ajax({
            type: 'POST',
            url: './resend-code',
            data: {
                userEmail: userEmail
            },
            dataType: 'json',
            success: function (response) {
                loader.style.display = "none";
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)"
                        },
                        // className: "toastify-success",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        location.reload();
                    }, 3200);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
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
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    $('#reset-form').submit(function (e) {
        e.preventDefault();

        var loader = document.getElementById("loader");
        loader.style.display = "block";

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: './password-reset',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                loader.style.display = "none";
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)"
                        },
                        // className: "toastify-success",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = "./login";
                    }, 3200);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
                        // className: "toastify-error",
                        stopOnFocus: true
                    }).showToast();
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                // console.log(xhr);
                Toastify({
                    text: "An unexpected error occurred",
                    duration: 3000,
                    close: true,
                    position: "center",
                    gravity: "top",
                    style: {
                        background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                    },
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    $('#pass-reset-form').submit(function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: './update-password',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)"
                        },
                        // className: "toastify-success",
                        stopOnFocus: true
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = "./login";
                    }, 3200);
                } else {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        position: "center",
                        gravity: "top",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                        },
                        // className: "toastify-error",
                        stopOnFocus: true
                    }).showToast();
                }
            },
            error: function (xhr, status, error) {
                Toastify({
                    text: "An unexpected error occurred",
                    duration: 3000,
                    close: true,
                    position: "center",
                    gravity: "top",
                    style: {
                        background: "linear-gradient(to right, #ff416c, #ff4b2b)"
                    },
                    // className: "toastify-error",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });
});