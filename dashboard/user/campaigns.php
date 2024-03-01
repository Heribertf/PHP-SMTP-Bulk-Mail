<?php
include_once "./includes/header.php";
require_once './includes/config.php';
require_once './includes/mysqli_connection.php';

$session_user = $_SESSION["id"];
?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Campaigns
    </h2>
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        All campaigns
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <div class="table-responsive">
                <table class="w-full whitespace-no-wrap" id="campaigns-table">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">
                                <div class='flex items-start'>#</div>
                            </th>
                            <th class="px-4 py-3">Campaign</th>
                            <th class="px-4 py-3">
                                <div class='flex items-center justify-center'>Recipients</div>
                            </th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php
                        $i = 1;

                        $query = "SELECT campaign_id, user_id, subject, message, DATE_FORMAT(date_sent, '%d-%b-%Y') AS formattedDate, sent_from, recipients
                            FROM 
                                campaigns
                            WHERE user_id = ?
                            ORDER BY date_sent DESC";

                        if ($stmt = mysqli_prepare($conn, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $session_user);
                            mysqli_stmt_execute($stmt);

                            mysqli_stmt_bind_result($stmt, $campignId, $userId, $subject, $message, $formattedDate, $senderEmail, $count);

                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr class='text-gray-700 dark:text-gray-400'>";
                                echo "<td class='px-4 py-3 text-sm'> <div class='flex justify-start'>" . $i++ . "</div></td>";
                                echo "<td class='px-4 py-3'>
                                <div class='flex items-center text-sm'>
                                <div>
                                <p class='font-semibold'>" . htmlspecialchars($subject) . "</p>
                                </div>
                                </div>
                                </td>";
                                echo "<td class='px-4 py-3 text-sm'> <div class='flex items-center justify-center'>" . htmlspecialchars($count) . "</div></td>";
                                echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($formattedDate) . "</td>";
                                echo "<td class='px-4 py-3'>
                                        <div class='flex items-center space-x-4 text-sm'>
                                            <button class='view-btn flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'
                                                aria-label='View'
                                                data-subject='" . htmlspecialchars($subject) . "'
                                                data-message='" . htmlspecialchars($message) . "'
                                                data-date='" . htmlspecialchars($formattedDate) . "'
                                                data-sender='" . htmlspecialchars($senderEmail) . "'
                                                data-recipients='" . htmlspecialchars($count) . "'>
                                                <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 24 24'>
                                                    <path d='M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z' />
                                                    <path fill-rule='evenodd'
                                                        d='M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z'
                                                        clip-rule='evenodd' />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>";

                                echo "</tr>";
                            }

                            mysqli_stmt_close($stmt);
                        } else {
                            echo "Error in prepared statement: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal with backdrop -->
    <div class="modal-backdrop hide-element" id="backdrop" tabindex="-1"></div> <!-- Backdrop -->

    <div class="modal hide-element" id="exampleModalCenter" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
                        id="exampleModalCenterTitle">View Campaign</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be dynamically populated here -->
                </div>
                <div
                    class="modal-footer flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                    <button type="button"
                        class="btn btn-secondary footer-btn w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</div>
<?php
include_once "./includes/footer.php";
?>
<script>

    $(document).ready(function () {
        new DataTable('#campaigns-table');
    });

    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-btn');
        const modal = document.getElementById('exampleModalCenter');
        const backdrop = document.getElementById('backdrop');


        viewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Extract data attributes from the button
                const subject = button.dataset.subject;
                const message = button.dataset.message;
                const date = button.dataset.date;
                const sender = button.dataset.sender;
                const recipients = button.dataset.recipients;

                console.log(subject);

                // Populate modal content
                const modalTitle = document.querySelector('.modal-title');
                const modalBody = document.querySelector('.modal-body');

                modalTitle.textContent = "View Campaign:";
                modalBody.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <div class="grid gap-6 mb-8 md:grid-cols-2">
                            <div class="min-w-0 p-4 rounded-lg shadow-xs dark:bg-gray-800">
                                <h4 class="mb-3 font-semibold text-gray-600 dark:text-gray-300">
                                    Email Subject:
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400">
                                    ${subject}
                                </p>
                            </div>
                            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <h4 class="mb-3 mt-2 font-semibold text-gray-600 dark:text-gray-300">
                                    Sent Date:
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400">
                                    ${date}
                                </p>
                            </div>
                        </div>
                        <div class="grid gap-6 mb-8 md:grid-cols-2">
                            <div class="min-w-0 p-4 rounded-lg shadow-xs dark:bg-gray-800">    
                                <h4 class="mb-3 mt-2 font-semibold text-gray-600 dark:text-gray-300">
                                    Target Recipients:
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400">
                                    ${recipients}
                                </p>
                            </div>
                            <div class="min-w-0 p-4 rounded-lg shadow-xs dark:bg-gray-800">
                                <h4 class="mb-3 mt-2 font-semibold text-gray-600 dark:text-gray-300">
                                    Sender Email:
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400">
                                    ${sender}
                                </p>
                            </div>
                        </div>
                        <div class="min-w-0 p-4 rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-3 mt-2 font-semibold text-gray-600 dark:text-gray-300">
                                Message:
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">
                                ${message}
                            </p>
                        </div>
                    </div>
                </div>`;

                // Show the modal
                // backdrop.classList.remove('hide-element');
                backdrop.style.display = 'block';
                modal.style.display = 'block';
            });
        });

        // Close the modal when the close button is clicked
        const closeButton = document.querySelector('.footer-btn');
        closeButton.addEventListener('click', function () {
            backdrop.style.display = 'none';
            modal.style.display = 'none';
        });

        document.querySelector('.modal-backdrop').addEventListener('click', function () {
            modal.style.display = 'none';
            backdrop.style.display = 'none';
        });

    });

</script>
<?php
include_once "./includes/footer-end.php";
?>