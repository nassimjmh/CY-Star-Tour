<?php
session_start();

if ( !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
        header('location: ../index.php');
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin page for managing users on StarTour">
    <title>User list - StarTour Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/admin-actions.js?v=<?php echo time(); ?>"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="users">
<style>
        .sidebar ul li a[href="users.php"] {
            color: #5e9ae9;
            position: relative;
        }
        .sidebar ul li a[href="users.php"]::before {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 1px;
            background: #5e9ae9;
        }
</style>
<?php include("bars.php") ?>

    <div class="admin-container">
        <div class="container-admin">
            <section>
                <h2>Manage Users</h2>
                <div class="filters">
                <form method="GET">
                    <input type="text" placeholder="Search users...">
                    <select id="status-filter">
                        <option value="X">All Status</option>
                        <option value="Banned">Banned</option>
                        <option value="Standard">Standard</option>
                        <option value="VIP">VIP</option>
                        <option value="Stellar Elite">Stellar Elite</option>
                        <option value="Admin">Admin</option>

                    </select>
                    <select id="race-filter">
                        <option value="">All Races</option>
                        <option value="human">Human</option>
                        <option value="ia">IA</option>
                        <option value="alien">Alien</option>
                        <option value="coruscant">Coruscant</option>
                    </select>
                <button type="submit">Apply</button>
                </form>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PP</th>
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>RACE</th>
                            <th>DATE OF BIRTH</th>
                            <th>ADMIN ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $file = file_get_contents("../../json/data/users.json");
                        $users = json_decode($file, true);
                        if(count($users)!=0){
                            // To sort users by ID 
                            uasort($users, function($a, $b) {
                                return $a['id'] - $b['id'];
                            });
                            foreach($users as $users){
                                ?>      
                                <tr>
                                    <td><?php echo "#" . str_pad($users["id"], 4, '0', STR_PAD_LEFT) ?></td>  <!-- Write ID with 5 digits -->
                                    <td>
                                        <?php 
                                        if (strpos($users["profile_pic"], 'http') === 0) {
                                            $imgSrc = $users["profile_pic"]; // For external links
                                        } else {
                                            $imgSrc = '../' . $users["profile_pic"]; // For local links in <upload> folder
                                        }
                                        ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                                    </td>                                    
                                    <td><?php echo $users["first_name"] ?></td>
                                    <td><?php echo $users["last_name"] ?></td>
                                    <td><a href="mailto:<?php echo $users["email"] ?>"><?php echo $users["email"] ?></a></td>
                                    <td><?php if ($users["role"] === 'Standard') {
                                        echo '<span style="color: #4CAF50; font-weight: bolder;">' . $users["role"] ;
                                    }
                                    else if($users["role"] === 'Admin') {
                                        echo '<span style="color: #5e9ae9; font-weight: bolder;">' . $users["role"] ;
                                    }
                                    else if($users["role"] === 'VIP') {
                                        echo '<span style="color: gold; font-weight: bolder;">' . $users["role"] ;
                                    }
                                    else if($users["role"] === 'Banned') {
                                        echo '<span style="color: #ff4444; font-weight: bolder;">' . $users["role"] ;
                                    }
                                    else if($users["role"] === 'Stellar Elite') {
                                        echo '<span style="color: #7851A9; font-weight: bolder;">' . $users["role"] ;
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $users["race"] ?></td>
                                    <td><?php 
                                        // Convert the date string to a DateTime object
                                        $date = new DateTime($users["date_picker"]);
                                        echo $date->format('d/m/Y'); ?></td>
                                    <td>
                                    <div class="action-buttons">
                                        <form method="POST" action="update_user.php" style="display: inline;">
                                            <input type="hidden" name="email" value="<?php echo $users['email']; ?>">
                                            <input type="hidden" name="current_role" value="<?php echo $users['role']; ?>">
                                            
                                            <?php if ($users['role'] !== 'VIP'): ?>
                                                <button type="submit" name="action" value="make_vip" class="vip-button action-button">
                                                    Make VIP
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="remove_vip" class="vip-button action-button">
                                                    Remove VIP
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($users['role'] !== 'Banned'): ?>
                                                <button type="submit" name="action" value="ban" class="ban-button action-button">
                                                    Ban User
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="unban" class="ban-button action-button">
                                                    Unban User
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($users['role'] !== 'Admin'): ?>
                                                <button type="submit" name="action" value="make_admin" class="admin-button action-button">
                                                    Make Admin
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="remove_admin" class="admin-button action-button">
                                                    Remove Admin
                                                </button>
                                            <?php endif; ?>

                                            <button type="submit" name="action" value="manage" class="manage-button action-button">
                                                Edit User
                                            </button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    </body>
</html>
