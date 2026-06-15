<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f4f7fc;
        }

        /* NAVBAR */
        .navbar{
            background:#1e293b;
            color:white;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .navbar h2{
            font-size:20px;
        }

        .navbar span{
            color:#94a3b8;
        }

        /* CONTAINER */
        .container{
            padding:30px;
        }

        /* WELCOME */
        .welcome{
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
            padding:30px;
            border-radius:16px;
            margin-bottom:30px;
            box-shadow:0 8px 25px rgba(0,0,0,0.1);
        }

        .welcome h1{
            margin-bottom:8px;
            font-size:24px;
        }

        /* CARDS */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            border-radius:16px;
            padding:25px;
            box-shadow:0 6px 18px rgba(0,0,0,0.08);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-6px);
        }

        .card h3{
            color:#64748b;
            margin-bottom:10px;
            font-size:14px;
        }

        .number{
            font-size:38px;
            font-weight:bold;
            color:#111827;
        }

        .total{ border-left:5px solid #2563eb; }
        .lost{ border-left:5px solid #ef4444; }
        .found{ border-left:5px solid #22c55e; }
        .returned{ border-left:5px solid #f59e0b; }

        /* QUICK LINKS */
        .quick-links{
            background:white;
            padding:25px;
            border-radius:16px;
            box-shadow:0 6px 18px rgba(0,0,0,0.08);
        }

        .quick-links h2{
            margin-bottom:15px;
        }

        .btn{
            display:inline-block;
            padding:12px 18px;
            margin-right:10px;
            margin-top:10px;
            text-decoration:none;
            color:white;
            border-radius:10px;
            transition:0.3s;
            font-weight:500;
        }

        .btn-add{ background:#2563eb; }
        .btn-view{ background:#22c55e; }

        .btn:hover{
            transform:scale(1.05);
            opacity:0.95;
        }

        /* FOOTER */
        footer{
            text-align:center;
            margin-top:40px;
            color:#64748b;
            font-size:14px;
        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>📦 Lost & Found Admin Panel</h2>
        <span>Welcome Admin</span>
    </div>

    <!-- CONTENT -->
    <div class="container">

        <!-- WELCOME -->
        <div class="welcome">
            <h1>Dashboard Overview</h1>
            <p>Monitor all lost and found item activities from one place.</p>
        </div>

        <!-- CARDS -->
        <div class="cards">

            <div class="card total">
                <h3>Total Items</h3>
                <div class="number">{{ $totalItems }}</div>
            </div>

            <div class="card lost">
                <h3>Lost Items</h3>
                <div class="number">{{ $lostItems }}</div>
            </div>

            <div class="card found">
                <h3>Found Items</h3>
                <div class="number">{{ $foundItems }}</div>
            </div>

            <div class="card returned">
                <h3>Returned Items</h3>
                <div class="number">{{ $returnedItems }}</div>
            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-links">
            <h2>Quick Actions</h2>

            <a href="{{ route('items.create') }}" class="btn btn-add">
                ➕ Add New Item
            </a>

            <a href="{{ route('items.index') }}" class="btn btn-view">
                📋 View All Items
            </a>
        </div>

        <!-- FOOTER -->
        <footer>
            Lost & Found Management System | Admin Dashboard
        </footer>

    </div>

</body>
</html>