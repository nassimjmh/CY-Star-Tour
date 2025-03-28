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
$race = $_SESSION["race"];
$date_picker = $_SESSION["date_picker"];
$profile_pic = $_SESSION["profile_pic"];
$id = $_SESSION["user_id"];

$target_dir = "uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $imageFileType = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
    $random_string = bin2hex(random_bytes(16)); // 32 character random string
    $target_file = $target_dir . $random_string . '.' . $imageFileType;

    if (isset($_POST["submit"])) {
        if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
            $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
            if ($check === false) {
                $error_message = "This file is not an image.";
            }
        } else {
            $error_message = "No file was uploaded or an error occurred.";
        }

        if ($_FILES["profile_pic"]["size"] > 500000) {
            $error_message = "Sorry, your file is too large.";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    
        if (empty($error_message)) {

                if (file_exists($users[$email]['profile_pic'])) {
                unlink($users[$email]['profile_pic']);
            }

            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {

                $users[$email]['profile_pic'] = $target_file;

                file_put_contents('../json/data/users.json', json_encode($users, JSON_PRETTY_PRINT));

                header('location: profil.php');
                exit;
            } else {
                $error_message = "Sorry, there was an error uploading your file.";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $users[$email]['last_name'] = $_POST['last_name'];
    $users[$email]['first_name'] = $_POST['first_name'];
    $users[$email]['race'] = $_POST['race'];
    $users[$email]['date_picker'] = $_POST['date_picker'];

    file_put_contents('../json/data/users.json', json_encode($users, JSON_PRETTY_PRINT));

    header("Location: profil.php");
    exit();
}

$last_name = $users[$email]['last_name'];
$first_name = $users[$email]['first_name'];
$race = $users[$email]['race'];
$date_picker = $users[$email]['date_picker'];

$edit_mode = isset($_POST['edit']);


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
</head>
<body>

<header>
    <?php include("navbar.php")?>
</header>

<main>
    <div class="sidebar">
        <div class="sidebar-head">
            <img src="<?php echo $users[$email]['profile_pic']; ?>" alt="Picture" class="profile-pic"></img>
            <form action="profil.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_pic" id="file-input" accept="image/*">
                <label for="file-input" class="file-label">
                    <i class='bx bx-edit'></i>
                </label>

                <button type="submit" name="submit" class="custom-btn">
                    <i class='bx bx-upload'></i>Upload
                </button>
                <?php if (!empty($error_message)): ?>
                    <div class="error-message" style="color: red; font-size: 12px; margin-top: 5px;">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <a href="#">Settings & Preferences &nbsp; <i class='bx bx-cog'></i></a>
        <a href="#">Payment & Billing &nbsp;<i class='bx bxs-credit-card'></i></a>
        <a href="#">Booking & Access &nbsp;<i class='bx bxs-calendar'></i></a>
        <a href="#">Help & Support &nbsp;<i class='bx bx-phone'></i></a>
        <div class="status">

            <?php
            if (isset($_SESSION['role'])) {
                $role = $_SESSION['role'];

                if ($role === 'Standard') {
                    echo ' <a href="subscription.php" style="color :  #4CAF50;">' . 'Status :&nbsp' . $role . '</a>';
                }
                else if ($role === 'Admin') {
                    echo ' <a href="subscription.php" style="color : #5e9ae9;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bxs-wrench'></i>" . '</a>';
                }
                else if ($role === 'VIP') {
                    echo ' <a href="subscription.php" style="color : gold;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bxl-sketch'></i>" . '</a>';
                }
                else if ($role === 'Banned') {
                    echo ' <a href="subscription.php" style="color :#ff4444 ;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bx-dizzy'></i>" . '</a>';
                }
                else if ($role === 'Stellar Elite') {
                    echo ' <a href="subscription.php" style="color :#7851A9 ;">' . 'Status :&nbsp' . $role . "&nbsp;&nbsp" . "<i class='bx bx-planet'></i>" . '</a>';
                }
            }
            ?>

        </div>

        <a class="logout" href="logout.php">Logout &nbsp;<i class='bx bx-log-out'></i></a>
    </div>

    <div class="info-profile">
        <div class="info">
            <h2>About Me</h2>
            <?php if (!$edit_mode): ?>
                <ul>
                    <li><strong>First Name:</strong> <?php echo htmlspecialchars($first_name); ?></li>
                    <li><strong>Last Name:</strong> <?php echo htmlspecialchars($last_name); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
                    <li><strong>Birth Date:</strong>
                    <?php 
                        // Convert the date string to a DateTime object
                        $date = new DateTime($date_picker);
                        echo $date->format('d/m/Y'); 
                    ?></li>
                    <li><strong>Race:</strong> <?php echo htmlspecialchars($race); ?></li>
                </ul>
                <form action="profil.php" method="POST">
                    <button type="submit" name="edit" class="edit-btn">Edit Profile</button>
                </form>
            <?php else: ?>
                <form action="profil.php" method="POST">
                    <ul>
                        <li>
                            <span>First Name:</span>
                            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                        </li>
                        <li>
                            <span>Last Name:</span>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                        </li>
                        <li>
                            <span>Birth Date:</span>
                            <input type="date" name="date_picker" min="3900-01-01" max="4025-01-01" value="<?php echo htmlspecialchars($date_picker); ?>" required>
                        </li>
                        <li>
                            <span>Race:</span>
                            <select id="race" name="race" required>
                                <option value="Human" <?php echo $race === 'Human' ? 'selected' : ''; ?>>Human</option>
                                <option value="IA" <?php echo $race === 'IA' ? 'selected' : ''; ?>>IA</option>
                                <option value="Alien" <?php echo $race === 'Alien' ? 'selected' : ''; ?>>Alien</option>
                                <option value="Coruscant" <?php echo $race === 'Coruscant' ? 'selected' : ''; ?>>Coruscant</option>
                            </select>
                        </li>

                    </ul>
                    <button type="submit" name="update" class="save-btn">Save Changes</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="recent-trips">
        <h2>Recently Booked Trips</h2>
       <?php
       $found = false;
if ( $recentlybooked != null ) {
       foreach ($recentlybooked as $value) {
           if ($value["id"] == $id) {
               echo $value["planet"] . "<br>";
               $false = true;
           }
       }
}
       else if  ( !$found ){
           echo "No planets booked yet.";
       }

       ?>
    </div>

    <div class="destinations-info">
        <h2>Upcoming Destinations</h2>
        <ul>
            <li>Alpha Centauri</li>
            <li>Andromeda</li>
            <li>Proxima B</li>
            <li>Jupiter Moon</li>
        </ul>
        <a href="#" class="see-more-btn">See More</a>
    </div>

</main>

<?php include("footer.php") ?>

</body>
</html>
