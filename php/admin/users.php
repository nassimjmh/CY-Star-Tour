<?php
session_start();

if ( !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
        header('location: ../../index.html');
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin page for managing users on StarTour">
    <title>StarTour - Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="dashboard">
<?php include("bars.php") ?>

    <div class="admin-container">
        <div class="container-admin">
            <section>
                <h2>Manage Users</h2>
                <div class="filters">
                    <input type="text" placeholder="Search users...">
                    <select id="status-filter">
                        <option value="">Filter by Status</option>
                        <option value="active">Active</option>
                        <option value="banned">Banned</option>
                        <option value="vip">VIP</option>
                    </select>
                    <select id="race-filter">
                        <option value="">Filter by Race</option>
                        <option value="human">Human</option>
                        <option value="ia">IA</option>
                        <option value="alien">Alien</option>
                        <option value="coruscant">Coruscant</option>
                    </select>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        $file = file_get_contents("../users.json");
                        $users = json_decode($file, true);
                        if(count($users)!=0){
                            foreach($users as $users){
                                ?>      
                                <tr>
                                    <td>#00000</td>
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
                                    ?>
                                    </td>
                                    <td><?php echo $users["race"] ?></td>
                                    <td><?php echo $users["date_picker"] ?></td>
                                    <td>
                                    <div class="action-buttons">
                                        <form method="POST" action="update_user.php" style="display: inline;">
                                            <input type="hidden" name="email" value="<?php echo $users['email']; ?>">
                                            <input type="hidden" name="current_role" value="<?php echo $users['role']; ?>">
                                            
                                            <?php if ($users['role'] !== 'VIP'): ?>
                                                <button type="submit" name="action" value="make_vip" class="vip-button">
                                                    Make VIP
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="remove_vip" class="vip-button">
                                                    Remove VIP
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($users['role'] !== 'Banned'): ?>
                                                <button type="submit" name="action" value="ban" class="ban-button">
                                                    Ban User
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="unban" class="ban-button">
                                                    Unban User
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($users['role'] !== 'Admin'): ?>
                                                <button type="submit" name="action" value="make_admin" class="admin-button">
                                                    Make Admin
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="remove_admin" class="admin-button">
                                                    Remove Admin
                                                </button>
                                            <?php endif; ?>

                                            <button type="submit" name="action" value="manage" class="manage-button">
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
