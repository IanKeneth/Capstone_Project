<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Request</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">
    <style>
        .transfer-container { padding: 20px; }
        .transfer-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }
        .transfer-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 1.8rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group.full-width { grid-column: span 2; }
        
        label { font-weight: bold; color: #555; font-size: 0.9rem; }
        .form-control {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }
        .submit-btn {
            grid-column: span 2;
            background-color: #f28c28;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .submit-btn:hover { background-color: #d6761d; }
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
                    <a href="index.php" class="nav-item ">
                        <i class="fa-solid fa-table-columns"></i> 
                        <span>Dashboard</span>
                    </a>
                    <a href="transfer_request.php" class="nav-item active">
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
                        <i class="fa-solid fa-right-from-bracket icon"></i> <span>Logout</span>
                    </a>
                </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button id="sidebarToggle" class="hamburger-btn"><i class="fa-solid fa-bars"></i></button>
                    <h1>Inventory Transfer</h1>
                </div>
                <div class="user-profile"><i class="fa-solid fa-circle-user"></i></div>
            </header>

            <section class="transfer-container">
                <div class="transfer-card">
                    <h2>Transfer Inventory Order</h2>
                    <form class="form-grid">
                        <div class="form-group">
                            <label>FROM (Source Location):</label>
                            <select class="form-control">
                                <option>Main Warehouse</option>
                                <option>Retailer Storage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>TO (Destination Location):</label>
                            <select class="form-control">
                                <option>Distribution Center</option>
                                <option>Main Warehouse</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ITEM (Product Name):</label>
                            <input type="text" class="form-control" placeholder="Search Item (e.g. Utility Brush)">
                        </div>
                        <div class="form-group">
                            <label>Requested Quantity:</label>
                            <input type="number" class="form-control" value="0">
                        </div>
                        <div class="form-group full-width">
                            <label>Transfer Notes (Optional):</label>
                            <textarea class="form-control" rows="3" placeholder="Additional details..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Create New Transfer Request</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
    <script>
        const sidebar = document.querySelector('.sidebar');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>