<?php

session_start();

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}

$users = json_decode(file_get_contents('../json/data/users.json'), true);

$email = $_SESSION['email'];
$first_name = $_SESSION["first_name"];
$role = $_SESSION["role"];
$last_name = $_SESSION["last_name"];
$date_picker = $_SESSION["date_picker"];
$profile_pic = $_SESSION["profile_pic"];
$id = $_SESSION["id"];

$target_dir = "../uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
    // Handle JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if ($input && isset($input['email'])) {
        $email = $input['email']; // Use email from input to identify the user

        if (isset($users[$email])) {
            $users[$email]['last_name'] = $input['last_name'];
            $users[$email]['first_name'] = $input['first_name'];
            $users[$email]['date_picker'] = $input['date_picker'];

            file_put_contents('../json/data/users.json', json_encode($users, JSON_PRETTY_PRINT));

            // Respond with success
            echo json_encode(['success' => true]);
        } else {
            // Respond with error if email not found
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    } else {
        // Respond with error
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    }
    exit();
}

$last_name = $users[$email]['last_name'];
$first_name = $users[$email]['first_name'];
$date_picker = $users[$email]['date_picker'];



$recentlybooked = json_decode(file_get_contents('../json/data/booking.json'), true);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>StarTour - Profile</title>
    <meta charset="utf-8">
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/profil.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/profile.js?v=<?php echo time(); ?>"></script>
</head>
<body>


<header>
    <?php include("navbar.php")?>
</header>

<main>
    <div class="sidebar">
        <div class="sidebar-head">
            <img id="profile-pic" src="<?php echo $users[$email]['profile_pic']; ?>" alt="Picture" class="profile-pic">

            <form id="upload-form" enctype="multipart/form-data">
                <input type="file" name="profile_pic" id="file-input" accept="image/*" required>
                <label for="file-input" class="file-label"><i class='bx bx-edit'></i></label>

                <button type="submit" class="custom-btn"><i class='bx bx-upload'></i>Upload</button>

                <div id="error-message" style="color: red; font-size: 12px; margin-top: 5px;"></div>
            </form>

            <!-- Loader -->
            <div id="profile-loader" class="loader-overlay" style="display: none;">
                <div class="spinner"></div>
            </div>
        </div>




        <script src="../js/profilepicture.js?v=<?php echo time(); ?>"></script>






        <a class="underline" href="comingsoon.php">Settings & Preferences &nbsp; <i class='bx bx-cog'></i></a>
        <a class="underline" href="comingsoon.php">Payment & Billing &nbsp;<i class='bx bxs-credit-card'></i></a>
        <a class="underline" href="#">Booking & Access &nbsp;<i class='bx bxs-calendar'></i></a>
        <a class="underline" href="https://mail.google.com/mail/?view=cm&fs=1&to=Startour.cy@gmail.com&su=Problem&body=20%20/%2020%20?" target="_blank"">Help & Support &nbsp;<i class='bx bx-phone'></i></a>
        <div class="status">

            <?php
            if (isset($_SESSION['role'])) {
                $role = $_SESSION['role'];

                if ($role === 'Standard') {
                    echo ' <a href="#" style="color :  #4CAF50;">' . 'Status :&nbsp' . $role . '</a>';
                }
                else if ($role === 'Admin') {
                    echo ' <a href="#" style="color : #5e9ae9;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bxs-wrench'></i>" . '</a>';
                }
                else if ($role === 'VIP') {
                    echo ' <a href="#" style="color : gold;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bxl-sketch'></i>" . '</a>';
                }
                else if ($role === 'Banned') {
                    echo ' <a href="#" style="color :#ff4444 ;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bx-dizzy'></i>" . '</a>';
                }
                else if ($role === 'Stellar Elite') {
                    echo ' <a href="#" style="color :#7851A9 ;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bx-planet'></i>" . '</a>';
                }
            }
            ?>

        </div>

        <a class="logout" href="logout.php">Logout &nbsp;<i class='bx bx-log-out'></i></a>
    </div>

    <div class="info-profile">
        <div class="info">
            <h2>About Me</h2>
            <ul id="profile-info">
                <li><strong>First Name:</strong> <span id="first-name"><?php echo htmlspecialchars($first_name); ?></span></li>
                <li><strong>Last Name:</strong> <span id="last-name"><?php echo htmlspecialchars($last_name); ?></span></li>
                <li><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($email); ?></span></li>
                <li><strong>Birth Date:</strong> <span id="birth-date"><?php echo $date_picker; ?></span></li>
            </ul>
            <button id="edit-btn" class="edit-btn"><img src="https://cdn-icons-png.flaticon.com/128/6218/6218548.png" alt="" class="param"></button>
            <button id="cancel-btn" class="cancel-btn" style="display: none;">Cancel</button>
            <button id="save-btn" class="save-btn" style="display: none;">Save</button>
        </div>
    </div>


    <div class="recent-trips">
        <h2>Recently Booked Trips</h2>


        <?php
        foreach ($recentlybooked as $value) {
            $imgSrc = '../images/planet/' . strtolower($value["planet"]) . ".webp";
            if ($value["id"] == $id && $value["payed"]===true) {?>
                <div class="book">
                    <p class="namebook"> <?php echo htmlspecialchars($value['planet'], ENT_QUOTES, 'UTF-8'); ?> </p>
                    <p class="optionbook"><strong>✨ Quality travel :</strong> <?php echo htmlspecialchars($value['quality'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="optionbook"><strong>☕ Breakfast :</strong> <?php echo htmlspecialchars($value['breakfast'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="optionbook"><strong>💆‍♂️ Zero gravity relaxation :</strong> <?php echo htmlspecialchars($value['relax'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="optionbook"><strong>🛡️ Cancellation insurance :</strong> <?php echo htmlspecialchars($value['insurance'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="optionbook"><strong>💸 Price :</strong> <?php echo htmlspecialchars($value['payment_amount'], ENT_QUOTES, 'UTF-8'); ?> ₴</p>
                    <img src='<?php echo $imgSrc ?>' class='planet-image'>
                </div>
            <?php }?>

        <?php }

        ?>

    </div>


</main>

<?php include("footer.php") ?>

</body>
</html>
