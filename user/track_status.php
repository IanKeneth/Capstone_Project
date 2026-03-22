<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Status - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">
    <style>
        .status-container { padding: 20px; }
        .status-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
        }
        .status-card h2 { text-align: center; margin-bottom: 20px; }
        
        .summary-badges {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .badge {
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .bg-orange { background-color: #f28c28; }
        .bg-green { background-color: #2ecc71; }
        .bg-red { background-color: #e74c3c; }

        .status-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .status-table th {
            text-align: left;
            padding: 15px;
            background: #fdfdfd;
            border-bottom: 2px solid #f28c28;
            color: #666;
            font-size: 0.8rem;
        }
        .status-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }
        .status-text { font-weight: bold; }
        .approved { color: #2ecc71; }
        .pending { color: #f1c40f; }
        
        .refresh-btn {
            background: #f28c28;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            float: right;
            margin-top: 20px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-boxes-stacked"></i> <span>Title</span>
            </div>
            <nav style="flex-grow: 1;">
                <a href="index.php" class="nav-item">
                    <i class="fa-solid fa-table-columns"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="transfer_request.php" class="nav-item">
                    <i class="fa-solid fa-right-left"></i> 
                    <span>Transfer Request</span>
                </a>
                <a href="track_status.php" class="nav-item active">
                    <i class="fa-solid fa-arrows-spin"></i> 
                    <span>Track Status</span>
                </a>
                <a href="basic_updates.php" class="nav-item">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Basic Updates</span>
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
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button id="sidebarToggle" class="hamburger-btn"><i class="fa-solid fa-bars"></i></button>
                    <h1>Track My Transfer</h1>
                </div>
            </header>

            <section class="status-container">
                <div class="status-card">
                    <h2>Track My Transfer</h2>
                    <div class="summary-badges">
                        <div class="badge bg-orange">TOTAL REQUEST: 25</div>
                        <div class="badge bg-green">ADMIN APPROVED: 12</div>
                        <div class="badge bg-red">ADMIN DECLINED: 3</div>
                    </div>

                    <table class="status-table">
                        <thead>
                            <tr>
                                <th>REQUEST ID</th>
                                <th>ITEM NAME</th>
                                <th>DATE REQUESTED</th>
                                <th>CURRENT STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>REQ-1001</td>
                                <td>Utility Brush (Long Handle)</td>
                                <td>2026-03-22</td>
                                <td class="status-text approved">Approved</td>
                            </tr>
                            <tr>
                                <td>REQ-1002</td>
                                <td>Microfiber Mop</td>
                                <td>2026-03-22</td>
                                <td class="status-text pending">Pending</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="refresh-btn">Refresh List</button>
                    <div style="clear: both;"></div>
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