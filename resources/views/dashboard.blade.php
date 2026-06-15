@php
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            display:flex;
            background:#f4f6f9;
        }

        /* SIDEBAR */
        .sidebar{
            width:240px;
            height:100vh;
            background:#111827;
            color:white;
            position:fixed;
            padding:20px;
        }

        .sidebar h2{
            text-align:center;
            margin-bottom:30px;
            font-size:18px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:12px;
            margin-bottom:10px;
            border-radius:8px;
            transition:0.3s;
        }

        .sidebar a:hover{
            background:#2563eb;
        }

        /* CONTENT */
        .content{
            margin-left:240px;
            width:100%;
            padding:25px;
        }

        /* TOPBAR */
        .topbar{
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
            margin-bottom:25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        /* CARDS */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:20px;
        }

        .card{
            color:white;
            padding:22px;
            border-radius:14px;
            text-align:center;
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .total{ background:linear-gradient(135deg,#3b82f6,#2563eb); }
        .lost{ background:linear-gradient(135deg,#ef4444,#dc2626); }
        .found{ background:linear-gradient(135deg,#10b981,#059669); }
        .returned{ background:linear-gradient(135deg,#f59e0b,#d97706); }

        .card p{
            font-size:30px;
            font-weight:bold;
            margin-top:10px;
        }

        /* BUTTONS */
        .btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 18px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:10px;
            margin-right:10px;
        }

        /* DARK MODE */
        #darkModeToggle{
            padding:10px 15px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            background:#111827;
            color:white;
        }

        .dark-mode{
            background:#0f172a;
            color:white;
        }

        .dark-mode .topbar{
            background:#1e293b;
            color:white;
        }

        .dark-mode .card{
            background:#334155;
        }

        .dark-mode .sidebar{
            background:#020617;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>📦 Lost & Found</h2>

    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('items.index') }}">📋 View Items</a>
    <a href="{{ route('items.myreports') }}">📄 My Reports</a>
    <a href="{{ route('items.report') }}">➕ Report Item</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="width:100%;padding:12px;background:#dc2626;color:white;border:none;border-radius:8px;margin-top:10px;">
            🚪 Logout
        </button>
    </form>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <h2>Welcome, {{ Auth::user()->name }} 👋</h2>
            <p>Admin Dashboard</p>
        </div>

        <button id="darkModeToggle">🌙 Dark Mode</button>
    </div>

    <!-- CARDS -->
    <div class="cards">

        <div class="card total">
            <h3>Total Items</h3>
            <p>{{ $totalItems }}</p>
        </div>

        <div class="card lost">
            <h3>Lost</h3>
            <p>{{ $lostItems }}</p>
        </div>

        <div class="card found">
            <h3>Found</h3>
            <p>{{ $foundItems }}</p>
        </div>

        <div class="card returned">
            <h3>Returned</h3>
            <p>{{ $returnedItems }}</p>
        </div>

    </div>

    <!-- CHART -->
    <div style="margin-top:25px;background:white;padding:20px;border-radius:15px;">
        <canvas id="dashboardChart"></canvas>
    </div>

    <!-- ACTION BUTTONS -->
    <div style="margin-top:20px;">
        <a href="{{ route('items.index') }}" class="btn">📋 View Items</a>
        <a href="{{ route('items.myreports') }}" class="btn">📄 My Reports</a>
        <a href="{{ route('items.report') }}" class="btn">➕ Report Item</a>
    </div>

</div>

<script>
new Chart(document.getElementById('dashboardChart'), {
    type: 'bar',
    data: {
        labels: ['Lost', 'Found', 'Returned'],
        datasets: [{
            label: 'Items',
            data: [
                {{ $lostItems }},
                {{ $foundItems }},
                {{ $returnedItems }}
            ]
        }]
    }
});

document.getElementById('darkModeToggle').addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
});
</script>

</body>
</html>