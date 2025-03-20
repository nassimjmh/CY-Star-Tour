<?php

session_start();

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}




$users = json_decode(file_get_contents('users.json'), true);

$email = $_SESSION['email'];
$first_name= $_SESSION["first_name"];
$role= $_SESSION["role"];
$last_name= $_SESSION["last_name"];
$race = $_SESSION["race"];
$date_picker = $_SESSION["date_picker"];
$profile_pic = $_SESSION["profile_pic"];

$target_dir = "uploads/";


if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if ( isset($_POST["submit"])){

        if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
            $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "Ce fichier n'est pas une image.";
                $uploadOk = 0;
            }
        } else {
            echo "Aucun fichier n'a été téléchargé ou une erreur s'est produite lors du téléchargement.";
            $uploadOk = 0;
        }
    }


    if ($_FILES["profile_pic"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop grand.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Mettre à jour l'URL de l'image dans les données utilisateur
            $users[$email]['profile_pic'] = $target_file;  // Chemin du fichier téléchargé

            // Sauvegarder les modifications dans le fichier JSON
            file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));


            header('location: profil.php');
            exit;
        } else {
            echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>StarTour - Profile</title>
    <meta charset="utf-8">
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/profil.css">
    <link rel="stylesheet" href="../css/style.css">
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
            </form>
        </div>
        <a href="#">Settings & Preferences &nbsp; <i class='bx bx-cog'></i></a>
        <a href="#">Payment & Billing &nbsp;<i class='bx bxs-credit-card'></i></a>
        <a href="#">Booking & Acess &nbsp;<i class='bx bxs-calendar'></i></a>
        <a href="#">Help & Support &nbsp;<i class='bx bx-phone'></i></a>
        <div class="status"> <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Standard') {
            echo ' <span style="color : green;">'.'Statut :&nbsp' . $role;
            }
else if( isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
    echo ' <span style="color : grey;">'.'Statut :&nbsp' . $role; 
}

else if( isset($_SESSION['role']) && $_SESSION['role'] === 'VIP') {
    echo ' <span style="color : gold;">'.'Statut :&nbsp' . $role;
}
else if( isset($_SESSION['role']) && $_SESSION['role'] === 'Banned') {
    echo ' <span style="color : red;">'.'Statut :&nbsp' . $role;
}
            ?> &nbsp;<i class='bx bxl-sketch'></i>
        </div>

        <a class="logout" href="logout.php">Logout &nbsp;<i class='bx bx-log-out'></i></a>
    </div>


    <div class="info-profile">
        <div class="info">
            <div class="header"><h1>About me&nbsp<a href="#"><i class='bx bx-edit'></i></a></h1></div>
            <div class="line">
                <span class="label">Last Name: </span>
                <span class="value"><?php echo $last_name; ?></span>
            </div>
            <div class="line">
                <span class="label">First Name:</span>
                <span class="value"><?php echo $first_name; ?></span>
            </div>
            <div class="line">
                <span class="label">Email:</span>
                <span class="value"><?php echo $email; ?></span>
            </div>
            <div class="line">
                <span class="label">Race:</span>
                <span class="value"><?php echo $race; ?></span>
            </div>
            <div class="line">
                <span class="label">Date of Birth:</span>
                <span class="value"><?php echo $date_picker; ?></span>
            </div>
        </div>
        <div class="recent-trips">
            <h2>Recently Booked Trips</h2>
            <ul>
                <li>Mars</li>
                <li>Venus</li>
                <li>Kargalan</li>
                <li>Robotcorp</li>
                <li>Litunaria</li>
                <li>Icebergotum</li>
            </ul>
        </div>
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


<!--FOOTER-->
<?php include("footer.php") ?>

</body>
</html>
