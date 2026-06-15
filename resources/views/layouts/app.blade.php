<!DOCTYPE html>
<html>
<head>
    <title>Lost & Found System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f4f6f9;
            animation: pageFade 0.4s ease-in-out;
        }

        /* PAGE LOAD ANIMATION */
        @keyframes pageFade{
            from{
                opacity:0;
                transform: translateY(10px);
            }
            to{
                opacity:1;
                transform: translateY(0);
            }
        }

        /* MOBILE HEADER */
        .mobile-header{
            display:none;
            background:#111827;
            color:white;
            padding:15px;
            justify-content:space-between;
            align-items:center;
            animation: slideDown 0.3s ease-in-out;
        }

        @keyframes slideDown{
            from{ transform: translateY(-100%); }
            to{ transform: translateY(0); }
        }

        .menu-btn{
            font-size:22px;
            cursor:pointer;
            transition:0.3s;
        }

        .menu-btn:hover{
            transform: rotate(90deg);
        }

        /* SIDEBAR */
        .sidebar{
            width:240px;
            height:100vh;
            background:#111827;
            color:white;
            position:fixed;
            padding:20px;
            left:0;
            top:0;

            transition: all 0.35s ease-in-out;
        }

        .sidebar h2{
            font-size:18px;
            margin-bottom:25px;
        }

        /* SIDEBAR LINKS */
        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:12px;
            border-radius:8px;
            margin-bottom:10px;

            transition: all 0.25s ease;
        }

        .sidebar a:hover{
            background:#2563eb;
            transform: translateX(8px);
        }

        /* CONTENT */
        .content{
            margin-left:240px;
            padding:25px;

            animation: fadeInContent 0.4s ease-in-out;
        }

        @keyframes fadeInContent{
            from{
                opacity:0;
                transform: translateY(10px);
            }
            to{
                opacity:1;
                transform: translateY(0);
            }
        }

        /* TOPBAR */
        .topbar{
            background:white;
            padding:18px;
            border-radius:12px;
            margin-bottom:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);

            transition:0.3s;
        }

        .topbar:hover{
            transform: translateY(-3px);
        }

        /* CARD */
        .card{
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);

            transition: all 0.3s ease;
        }

        .card:hover{
            transform: translateY(-8px) scale(1.02);
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        /* OVERLAY */
        .overlay{
            display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);

            animation: fadeOverlay 0.3s ease;
        }

        @keyframes fadeOverlay{
            from{ opacity:0; }
            to{ opacity:1; }
        }

        /* MOBILE */
        @media (max-width: 768px){

            .sidebar{
                left:-260px;
            }

            .sidebar.active{
                left:0;
            }

            .content{
                margin-left:0;
            }

            .mobile-header{
                display:flex;
            }

            .overlay.active{
                display:block;
            }
        }

    </style>
</head>

<body>

<!-- MOBILE HEADER -->
<div class="mobile-header">
    <span class="menu-btn" onclick="toggleMenu()">☰</span>
    <span>Lost & Found</span>
</div>

<!-- OVERLAY -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <h2>📦 Lost & Found</h2>

    @auth
        @if(auth()->user()->role === 'admin')

            <a href="{{ route('dashboard') }}">🏠 Admin Dashboard</a>
            <a href="{{ route('items.index') }}">📋 Manage Items</a>
            <a href="{{ route('items.create') }}">➕ Add Item</a>

        @else

            <a href="{{ route('dashboard') }}">🏠 My Dashboard</a>
            <a href="{{ route('items.index') }}">📋 View Items</a>
            <a href="{{ route('items.myreports') }}">📄 My Reports</a>
            <a href="{{ route('items.report') }}">➕ Report Item</a>

        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="width:100%;padding:12px;background:#dc2626;color:white;border:none;border-radius:8px;margin-top:15px;transition:0.3s;"
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'">
                🚪 Logout
            </button>
        </form>
    @endauth

</div>

<!-- CONTENT -->
<div class="content">

    <div class="topbar">
        <h3>Welcome, {{ auth()->user()->name }}</h3>
    </div>

    @yield('content')

</div>

<script>
function toggleMenu(){
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('overlay').classList.toggle('active');
}
</script>

</body>
</html>