<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../user/css/style.css">
    <style>
        .order-section { padding: 20px; }
        
        .order-title-bar {
            background-color: #f28c28;
            color: white;
            padding: 12px;
            border-radius: 25px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .orders-table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .orders-table th {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #fffdfa;
            color: #333;
            font-size: 0.9rem;
        }

        .orders-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            font-size: 0.85rem;
        }

        .status-transit { color: #2980b9; font-weight: 500; }
        .status-delivered { color: #27ae60; font-weight: 500; }
        .status-processing { color: #e67e22; font-weight: 500; }
        
        .refresh-btn {
            float: right;
            margin-top: 20px;
            background-color: #f28c28;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: #fff;
            margin: 10% auto;
            padding: 20px;
            width: 400px;
            border-radius: 10px;
        }

        .modal-content input,
        .modal-content select {
            width: 98%;
            padding: 8px;
            margin: 5px 0 10px;
            
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
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
                <a href="transfer_request.php" class="nav-item">
                    <i class="fa-solid fa-right-left"></i> 
                    <span>Transfer Request</span>
                </a>
            
                <a href="basic_reports.php" class="nav-item ">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Basic Reports</span>
                </a>
                 <a href="orders.php" class="nav-item active">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    <span>Order</span>
                </a>
                <a href="sales.php" class="nav-item">
                    <i class="fa-solid fa-chart-simple"></i> 
                    <span>Sales</span>
                </a>
                <a href="supplies.php" class="nav-item ">
                    <i class="fa-solid fa-truck-ramp-box icon"></i> 
                    <span>Supplies</span>
                </a>
                <a href="settings.php" class="nav-item">
                    <i class="fa-solid fa-user-gear"></i> 
                    <span>Profile</span>
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
                    <h1>Track Orders</h1>
                </div>
                <div class="user-profile">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
            </header>

            <section class="order-section">
                <div class="order-title-bar">Track Orders & Deliveries</div>

                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Estimated Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CS001</td>
                            <td>Brooms</td>
                            <td>90 pcs</td>
                            <td class="status-transit">In Transit</td>
                            <td>2026-03-20</td>
                        </tr>
                        <tr>
                            <td>CS002</td>
                            <td>Buckets</td>
                            <td>50 pcs</td>
                            <td class="status-transit">In Transit</td>
                            <td>2026-04-03</td>
                        </tr>
                        <tr>
                            <td>CS003</td>
                            <td>Brushes</td>
                            <td>70 pcs</td>
                            <td class="status-transit">In Transit</td>
                            <td>2026-03-07</td>
                        </tr>
                        <tr>
                            <td>CS004</td>
                            <td>Doormats</td>
                            <td>120 pcs</td>
                            <td class="status-delivered">Delivered</td>
                            <td>2026-03-12</td>
                        </tr>
                        <tr>
                            <td>CS005</td>
                            <td>Buckets & Pads</td>
                            <td>50 pcs</td>
                            <td class="status-delivered">Delivered</td>
                            <td>2026-03-12</td>
                        </tr>
                        <tr>
                            <td>CS002</td>
                            <td>Brooms</td>
                            <td class="status-processing">Processing</td>
                            <td class="status-processing">Processing</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CS006</td>
                            <td>Brushes</td>
                            <td>Pending</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <button class="refresh-btn">Refresh</button>
                <button class="refresh-btn" onclick="openForm()">Add Customers</button>

                <div id="popupForm" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeForm()">&times;</span>
                    <h2 style="color: #e67e22;">Customers list</h2>

                    <form>
                        <label>Customer Name:</label>
                        <input type="text" name="customer_name" required>

                        <label>Product:</label>
                        <input type="text" name="product" required>

                        <label>Quantity:</label>
                        <input type="number" name="quantity" required>

                        <label>Status:</label>
                        <select name="status" required>
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Processing">Processing</option>
                            <option value="Delivered">Delivered</option>
                        </select>

                        <label>Estimated Delivery:</label>
                        <input type="date" name="estimated_delivery" required>

                        <button type="submit" style="color: #e67e22;">Save</button>
                    </form>
                </div>
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

        function openForm() {
        document.getElementById("popupForm").style.display = "block";
        }

        function closeForm() {
        document.getElementById("popupForm").style.display = "none";
        }
    </script>
</body>
</html>