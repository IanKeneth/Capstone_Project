<?php
session_start();
require "../app/conn.php";


if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../app/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">

    <style>
        .sidebar { background-color: var(--primary-orange); color: black; display: flex; flex-direction: column; }
        .sidebar-profile { text-align: center; padding: 30px 10px; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .profile-img { width: 70px; height: 70px; background: white; border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: var(--primary-orange); font-size: 35px; }
        .sidebar-profile h3 { font-size: 1.2rem; letter-spacing: 2px; margin: 0; }
        

        /* Gauge / Analytics Styling */
        .quick-overview { margin-bottom: 25px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .card-header { background: #fff; padding: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px; color: #555; }
        
        .gauge-container { display: flex; justify-content: space-around; padding: 25px; background: #fff; flex-wrap: wrap; gap: 20px; }
        .gauge-item { text-align: center; flex: 1; min-width: 120px; }
        .gauge-circle { width: 120px; height: 60px; border: 10px solid #eee; border-bottom: 0; border-radius: 120px 120px 0 0; position: relative; display: flex; align-items: flex-end; justify-content: center; margin: 0 auto 10px; }
        .gauge-circle span { font-weight: bold; font-size: 1.2rem; position: relative; top: 5px; }
        
        .blue { border-top-color: #3498db; border-left-color: #3498db; }
        .red { border-top-color: #e74c3c; }
        .yellow { border-top-color: #f1c40f; border-right-color: #f1c40f; }
        .green { border-top-color: #2ecc71; border-right-color: #2ecc71; border-left-color: #2ecc71;}

        /* Detailed Table Styling */
        .inventory-list-card { background: white; border: 1px solid #ddd; border-radius: 8px; }
        .inventory-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .inventory-table th { background: #fff; color: #888; text-align: left; padding: 12px; border-bottom: 2px solid #eee; font-size: 0.9rem; }
        .inventory-table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.95rem; color: #444; }
        .status-reorder { color: #e74c3c; font-weight: bold; }
        .status-normal { color: #2ecc71; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-boxes-stacked"></i> 
                <span>Title</span>
            </div>

            <nav style="flex-grow: 1;">
                <a href="index.php" class="nav-item active ">
                    <i class="fa-solid fa-table-columns"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="transfer_request.php" class="nav-item">
                    <i class="fa-solid fa-right-left"></i> 
                    <span>Transfer Request</span>
                </a>
        
                <a href="basic_reports.php" class="nav-item">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Basic Reports</span>
                </a>
                <a href="orders.php" class="nav-item">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Order</span>
                </a>
                <a href="sales.php" class="nav-item">
                    <i class="fa-solid fa-chart-simple"></i> 
                    <span>Sales</span>
                </a>
               
                <a href="settings.php" class="nav-item">
                    <i class="fa-solid fa-user-gear"></i> 
                    <span>Profile</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="../app/logout.php" class="nav-item">
                    <i class="fa-solid fa-right-from-bracket"></i> 
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button id="sidebarToggle" class="hamburger-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1>Dashboard</h1>
                </div>
                <div class="user-profile">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
            </header>

            <section class="quick-overview">
                <div class="card-header">
                    <i class="fa-solid fa-layer-group" style="color: var(--primary-orange);"></i>
                    <strong>Quick Inventory Overview</strong>
                </div>
                <div class="gauge-container">
                    <div class="gauge-item">
                        <div class="gauge-circle blue"><span>1000</span></div>
                        <p>TOTAL Units</p>
                    </div>
                    <div class="gauge-item">
                        <div class="gauge-circle red"><span>87</span></div>
                        <p>LOW Stock</p>
                    </div>
                    <div class="gauge-item">
                        <div class="gauge-circle yellow"><span>5000</span></div>
                        <p>STOCK VALUE</p>
                    </div>
                    <div class="gauge-item">
                        <div class="gauge-circle green"><span>+45</span></div>
                        <p>UPDATES (24h)</p>
                    </div>
                </div>
            </section>

            <section class="inventory-list-card">
                <div class="card-header">
                    <i class="fa-solid fa-file-lines" style="color: var(--primary-orange);"></i>
                    <strong>Detailed Inventory List</strong>
                </div>
                <div style="padding: 0 15px 15px 15px;">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>ITEM ID</th>
                                <th>ITEM NAME</th>
                                <th>CATEGORY</th>
                                <th>ON HAND</th>
                                <th>LOW STOCK ALERT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Microfiber Mop</td>
                                <td>Mops</td>
                                <td>150</td>
                                <td class="status-normal">NORMAL</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Doormat (Large)</td>
                                <td>Doormat</td>
                                <td>20</td>
                                <td class="status-reorder">REORDER</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Utility Brush</td>
                                <td>Brush</td>
                                <td>50</td>
                                <td class="status-reorder">REORDER</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Brooms (Heavy)</td>
                                <td>Brooms</td>
                                <td>200</td>
                                <td class="status-normal">NORMAL</td>
                            </tr>
                            <tr>
                                <td>005</td>
                                <td>Bucket (Large)</td>
                                <td>Buckets</td>
                                <td>170</td>
                                <td class="status-normal">NORMAL</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>