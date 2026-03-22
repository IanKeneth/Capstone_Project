<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales - Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">
    <style>
        .sales-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin: 20px;
            padding: 25px;
        }
        .sales-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .sales-table {
            width: 100%;
            border-collapse: collapse;
        }
        .sales-table th {
            background-color: #fdfdfd;
            color: #666;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #f28c28;
        }
        .sales-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
            color: #444;
        }
        .amount-text {
            font-weight: bold;
            color: #2ecc71; /* Green for profit/sales */
        }
        .price-text {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <<div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-boxes-stacked"></i> 
                <span>Title</span>
            </div>
            <nav style="flex-grow: 1;">
                <a href="index.php" class="nav-item ">
                    <i class="fa-solid fa-table-columns"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="transfer_request.php" class="nav-item">
                    <i class="fa-solid fa-right-left"></i> 
                    <span>Transfer Request</span>
                </a>
                <a href="track_status.php" class="nav-item">
                    <i class="fa-solid fa-arrows-spin"></i> 
                    <span>Track Status</span>
                </a>
                <a href="basic_updates.php" class="nav-item">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Basic Updates</span>
                </a>
                <a href="sales.php" class="nav-item active">
                    <i class="fa-solid fa-chart-simple"></i> 
                    <span>Sales</span>
                </a>
                <a href="settings.php" class="nav-item">
                    <i class="fa-solid fa-user-gear"></i> 
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button id="sidebarToggle" class="hamburger-btn"><i class="fa-solid fa-bars"></i></button>
                    <h1>Sales Management</h1>
                </div>
                <div class="user-profile"><i class="fa-solid fa-circle-user"></i></div>
            </header>

            <section class="sales-card">
                <div class="sales-header">
                    <h2><i class="fa-solid fa-coins" style="color: #f28c28;"></i> Recent Sales (PHP)</h2>
                </div>

                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Sales_ID</th>
                            <th>Product Name</th>
                            <th>Custumor_Name</th>
                            <th>Sales_Quantity</th>
                            <th>Price</th>
                            <th>Total_Ammount</th>
                            <th>Sales_Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SID-001</td>
                            <td><strong>Brooms</strong></td>
                            <td>John</td>
                            <td>2 unit</td>
                            <td class="price-text">₱150.00</td>
                            <td class="amount-text">₱300.00</td>
                            <td>2026-03-22</td>
                        </tr>
                        <tr>
                            <td>SID-002</td>
                            <td><strong>Doormats</strong></td>
                            <td>Doe</td>
                            <td>3 units</td>
                            <td class="price-text">₱120.00</td>
                            <td class="amount-text">₱360.00</td>
                            <td>2026-03-22</td>
                        </tr>
                        <tr>
                            <td>SID-003</td>
                            <td><strong>Brushes</strong></td>
                            <td>han</td>
                            <td>4 units</td>
                            <td class="price-text">₱75.00</td>
                            <td class="amount-text">₱300.00</td>
                            <td>2026-03-21</td>
                        </tr>
                        <tr>
                            <td>SID-004</td>
                            <td><strong>Buckets</strong></td>
                            <td>Hoe</td>
                            <td>5 units</td>
                            <td class="price-text">₱200.00</td>
                            <td class="amount-text">₱1000.00</td>
                            <td>2026-03-20</td>
                        </tr>
                    </tbody>
                </table>
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