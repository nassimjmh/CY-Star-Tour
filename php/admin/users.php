<?php
session_start();

if ( !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
        header('location: ../index.php');
        exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action']) && $input['action'] === 'update_role') {
        header('Content-Type: application/json');
        
        if (!isset($input['email']) || !isset($input['new_role'])) {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
            exit();
        }
        
        $email = $input['email'];
        $newRole = $input['new_role'];
        $validRoles = ['Admin', 'VIP', 'Standard', 'Banned', 'Stellar Elite'];
        
        if (!in_array($newRole, $validRoles)) {
            echo json_encode(['success' => false, 'message' => 'Invalid role']);
            exit();
        }
        
        $usersFile = "../../json/data/users.json";
        $users = json_decode(file_get_contents($usersFile), true);
        
        if (!isset($users[$email])) {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            exit();
        }
        
        // Verif pour pas supprimer le dernier admin
        if ($users[$email]['role'] === 'Admin' && $newRole !== 'Admin') {
            $adminCount = 0;
            foreach ($users as $user) {
                if ($user['role'] === 'Admin') {
                    $adminCount++;
                }
            }
            
            if ($adminCount <= 1) {
                echo json_encode(['success' => false, 'message' => 'Cannot remove the last admin']);
                exit();
            }
        }
        
        $users[$email]['role'] = $newRole;
        
        if (file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user']);
        }
        exit();
    }
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') { // Verifier si c'est une requete ajax
    $file = file_get_contents("../../json/data/users.json");
    $users = json_decode($file, true);

    if (count($users) != 0) {
        uasort($users, function ($a, $b) {
            return $a['id'] - $b['id']; // Trier par id
        });

        ob_start(); // Start tbody
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo "#" . str_pad($user["id"], 4, '0', STR_PAD_LEFT); ?></td>
                <td>
                    <?php
                    if (strpos($user["profile_pic"], 'http') === 0) {
                        $imgSrc = $user["profile_pic"];
                    } else {
                        $imgSrc = '../' . $user["profile_pic"];
                    }
                    ?>
                    <img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                </td>
                <td><?php echo $user["first_name"]; ?></td>
                <td><?php echo $user["last_name"]; ?></td>
                <td><a href="mailto:<?php echo $user["email"]; ?>"><?php echo $user["email"]; ?></a></td>
                <td>
                    <?php
                    $roleColors = [
                        'Standard' => '#4CAF50',
                        'Admin' => '#5e9ae9',
                        'VIP' => 'gold',
                        'Banned' => '#ff4444',
                        'Stellar Elite' => '#7851A9'
                    ];
                    echo '<span style="color: ' . $roleColors[$user["role"]] . '; font-weight: bolder;">' . $user["role"] . '</span>';
                    ?>
                </td>
                <td><?php echo $user["race"]; ?></td>
                <td><?php
                    $date = new DateTime($user["date_picker"]);
                    echo $date->format('d/m/Y'); ?></td>
                <td>
                    <div class="action-buttons">
                        <div style="display: inline;">
                            <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                            <input type="hidden" name="current_role" value="<?php echo $user['role']; ?>">
                            <?php if ($user['role'] !== 'VIP'): ?>
                                <button type="button" name="action" value="make_vip" class="vip-button action-button">
                                    Make VIP
                                </button>
                            <?php else: ?>
                                <button type="button" name="action" value="remove_vip" class="vip-button action-button">
                                    Remove VIP
                                </button>
                            <?php endif; ?>
                            <?php if ($user['role'] !== 'Banned'): ?>
                                <button type="button" name="action" value="ban" class="ban-button action-button">
                                    Ban User
                                </button>
                            <?php else: ?>
                                <button type="button" name="action" value="unban" class="ban-button action-button">
                                    Unban User
                                </button>
                            <?php endif; ?>
                            <?php if ($user['role'] !== 'Admin'): ?>
                                <button type="button" name="action" value="make_admin" class="admin-button action-button">
                                    Make Admin
                                </button>
                            <?php else: ?>
                                <button type="button" name="action" value="remove_admin" class="admin-button action-button">
                                    Remove Admin
                                </button>
                            <?php endif; ?>
                                <button type="button" name="action" value="manage" class="manage-button action-button">
                                    Edit User
                                </button>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
        echo ob_get_clean(); // End tbody
    }
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
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/style.css">
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
                <!--<form method="GET">
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
                </form> -->
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
                    </tbody>
                </table>
            </section>
        </div>
    </div>
        <script src="../../js/admin-actions.js?v=<?php echo time(); ?>"></script>
        <script src="../../js/users.js?v=<?php echo time(); ?>"></script>
    </body>
</html>
