<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lost & Found System</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
}

/* NAVBAR */
nav {
    display: flex;
    justify-content: space-between;
    padding: 20px 60px;
    background: rgba(0,0,0,0.3);
    backdrop-filter: blur(10px);
}

nav h1 {
    font-size: 22px;
    color: #38bdf8;
}

nav a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
    transition: 0.3s;
}

nav a:hover {
    color: #38bdf8;
}

/* HERO */
.hero {
    text-align: center;
    padding: 100px 20px;
}

.hero h2 {
    font-size: 45px;
    margin-bottom: 10px;
}

.hero p {
    color: #cbd5e1;
    font-size: 18px;
}

/* BUTTON */
.btn {
    margin-top: 20px;
    padding: 12px 25px;
    background: #38bdf8;
    border: none;
    border-radius: 8px;
    color: black;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #0ea5e9;
}

/* CARDS */
.container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    padding: 50px;
}

.card {
    background: rgba(255,255,255,0.08);
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.15);
}

.card h3 {
    color: #38bdf8;
}
</style>

</head>

<body>

<nav>
    <h1>🎒 Lost & Found</h1>
    <div>
        <a href="#">Home</a>
        <a href="#">Items</a>
        <a href="#">Dashboard</a>
        <a href="#">Login</a>
    </div>
</nav>

<div class="hero">
    <h2>Find Lost Items Easily</h2>
    <p>Smart system to report, track and manage lost & found items in your campus</p>
    <button class="btn">Get Started</button>
</div>

<div class="container">

    <div class="card">
        <h3>Total Items</h3>
        <p>150+</p>
    </div>

    <div class="card">
        <h3>Lost Items</h3>
        <p>45</p>
    </div>

    <div class="card">
        <h3>Found Items</h3>
        <p>80</p>
    </div>

    <div class="card">
        <h3>Returned</h3>
        <p>25</p>
    </div>

</div>

</body>
</html>
