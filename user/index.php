<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">
</head>
<body>

    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-boxes-stacked"></i> 
                <span>Title</span>
            </div>

            <nav>
                <a href="index.ejs" class="nav-item active">
                    <i class="fa-solid fa-chart-line icon"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="inventory.ejs" class="nav-item">
                    <i class="fa-solid fa-boxes-packing icon"></i> 
                    <span>Inventory</span>
                </a>
                <a href="orders.ejs" class="nav-item">
                    <i class="fa-solid fa-cart-shopping icon"></i> 
                    <span>Orders</span>
                </a>
                <a href="reports.ejs" class="nav-item">
                    <i class="fa-solid fa-file-invoice-dollar icon"></i> 
                    <span>Reports</span>
                </a>
                <a href="supplies.ejs" class="nav-item">
                    <i class="fa-solid fa-truck-ramp-box icon"></i> 
                    <span>Supplies</span>
                </a>
                <a href="settings.ejs" class="nav-item">
                    <i class="fa-solid fa-gears icon"></i> 
                    <span>Settings</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="http://localhost/capstone/app/login.php" class="nav-item">
                    <i class="fa-solid fa-right-from-bracket icon"></i> 
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

            <section class="analytics-row">
                <div class="card sales-analytics">
                    <h3><i class="fa-solid fa-chart-area" style="color: #f28c28; margin-right: 10px;"></i>Sales Analytics</h3>
                    <div class="chart-placeholder">
                        </div>
                </div>

                <div class="card sales-stat">
                    <h3>Total Sales</h3>
                    <div class="stat-value">$142,500</div>
                    <div class="stat-change">
                        <i class="fa-solid fa-arrow-trend-up"></i> +12% from last month
                    </div>
                </div>
            </section>

            <section class="data-row">
                <div class="card stock-levels">
                    <h3><i class="fa-solid fa-layer-group" style="color: #f28c28; margin-right: 10px;"></i>Current Stock Level</h3>
                    <ul>
                        <li><span>Brooms</span> <strong>1500 units</strong></li>
                        <li><span>Doormats</span> <strong>850 units</strong></li>
                        <li><span>Brushes</span> <strong>2100 units</strong></li>
                        <li><span>Buckets</span> <strong>1200 units</strong></li>
                    </ul>
                </div>

                <div class="card recent-orders">
                    <h3><i class="fa-solid fa-clock-rotate-left" style="color: #f28c28; margin-right: 10px;"></i>Recent Orders</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#CS001</td>
                                <td>50 pcs</td>
                                <td class="status-shipped"><i class="fa-solid fa-circle-check"></i> Shipped</td>
                            </tr>
                            <tr>
                                <td>#CS002</td>
                                <td>120 pcs</td>
                                <td class="status-pending"><i class="fa-solid fa-circle-dot"></i> Pending</td>
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