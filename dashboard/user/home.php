<?php
include_once "./includes/header.php";
require_once './includes/config.php';
require_once './includes/mysqli_connection.php';

$session_user = $_SESSION['id'];

$statQuery = "SELECT SUM(recipients) AS total_recipients FROM campaigns WHERE user_id = ?";
$total_recipients = 0;

if ($stmt1 = mysqli_prepare($conn, $statQuery)) {
  mysqli_stmt_bind_param($stmt1, "i", $param_userid);

  $param_userid = $session_user;

  if (mysqli_stmt_execute($stmt1)) {
    mysqli_stmt_store_result($stmt1);

    if (mysqli_stmt_num_rows($stmt1) > 0) {
      mysqli_stmt_bind_result($stmt1, $recipient_count);
      mysqli_stmt_fetch($stmt1);
      $total_recipients = $recipient_count;
    }
  }
  mysqli_stmt_close($stmt1);
}
?>
<!-- <main class="h-full overflow-y-auto"> -->
<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Welcome
    <?php echo htmlspecialchars($_SESSION["username"]); ?>
  </h2>

  <!-- Cards -->
  <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
          </path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Your plan
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          Free Plan
        </p>
      </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
            clip-rule="evenodd"></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Total campaigns
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          <?php
          echo $conn->query("SELECT user_id FROM `campaigns` WHERE user_id = $session_user ")->num_rows;
          ?>
        </p>
      </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
          </path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Total target recipients
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          <?php echo htmlspecialchars($total_recipients); ?>
        </p>
      </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
            clip-rule="evenodd"></path>
        </svg>
      </div>
      <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
          Open rate
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
          86%
        </p>
      </div>
    </div>

  </div>

  <!-- Charts -->
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Charts
  </h2>
  <div class="grid gap-6 mb-8 md:grid-cols-2">
    <!-- <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
        Revenue
      </h4>
      <canvas id="pie"></canvas>
      <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
        <!-- Chart legend --
        <div class="flex items-center">
          <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
          <span>Shirts</span>
        </div>
        <div class="flex items-center">
          <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
          <span>Shoes</span>
        </div>
        <div class="flex items-center">
          <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
          <span>Bags</span>
        </div>
      </div>
    </div> -->
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
        Traffic
      </h4>
      <canvas id="line"></canvas>
      <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
        <!-- Chart legend -->
        <div class="flex items-center">
          <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
          <span>Organic</span>
        </div>
        <div class="flex items-center">
          <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
          <span>Paid</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once "./includes/footer.php";
?>
<?php
include_once "./includes/footer-end.php";
?>