<?php
session_start();

if ( !isset($_SESSION['email']) || !isset($_SESSION['password']) ) {

    header('location: ../login.php');
}

if ( !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    
        header('location: ../../index.html');
}

$email = $_SESSION['email'];
$first_name= $_SESSION["first_name"];
$role= $_SESSION["role"];
$last_name= $_SESSION["last_name"];
$race = $_SESSION["race"];
$date_picker = $_SESSION["date_picker"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin page for managing users on StarTour">
    <title>StarTour - Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css">
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
                        <tr>
                            <td>#15081</td>
                            <td>John</td>
                            <td>Doe</td>
                            <td><a href="mailto:john@example.com">john@example.com</a></td>
                            <td>DEFAULT</td>
                            <td>Human</td>
                            <td>1990-01-01</td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="" class="vip-button">Toggle VIP</button>
                                    <button onclick="" class="ban-button">Ban User</button>
                                    <button onclick="" class="manage-button">Manage User</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#10167</td>
                            <td>Benoît</td>
                            <td>Hébert</td>
                            <td><a href="mailto:b-hebert@yahoo.com">b-hebert@yahoo.com</a></td>
                            <td>VIP</td>
                            <td>Human</td>
                            <td>1992-02-02</td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="" class="vip-button">Toggle VIP</button>
                                    <button onclick="" class="ban-button">Ban User</button>
                                    <button onclick="" class="manage-button">Manage User</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#45566</td>
                            <td>AI</td>
                            <td>Bot</td>
                            <td><a href="mailto:ai@example.com">ai@example.com</a></td>
                            <td>BANNED</td>
                            <td>IA</td>
                            <td>2020-03-03</td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="" class="vip-button">Toggle VIP</button>
                                    <button onclick="" class="ban-button">Ban User</button>
                                    <button onclick="" class="manage-button">Manage User</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#00897</td>
                            <td>Zor</td>
                            <td>El</td>
                            <td><a href="mailto:zor@example.com">zor@example.com</a></td>
                            <td>ADMIN</td>
                            <td>Alien</td>
                            <td>1985-04-04</td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="" class="vip-button">Toggle VIP</button>
                                    <button onclick="" class="ban-button">Ban User</button>
                                    <button onclick="" class="manage-button">Manage User</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#11010</td>
                            <td>Cor</td>
                            <td>Uscant</td>
                            <td><a href="mailto:cor@example.com">cor@example.com</a></td>
                            <td>DEFAULT</td>
                            <td>Coruscant</td>
                            <td>1975-05-05</td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="" class="vip-button">Toggle VIP</button>
                                    <button onclick="" class="ban-button">Ban User</button>
                                    <button onclick="" class="manage-button">Manage User</button>
                                </div>
                            </td>
                    </tbody>
                </table>
                <div class="pagination">
                    <button>Previous</button>
                    <button>Next</button>
                </div>
            </section>
        </div>
    </div>

    </body>
</html>
