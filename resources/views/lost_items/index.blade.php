
<!DOCTYPE html>
<html>
<head>
    <title>Lost & Found Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6fb;
    margin: 0;
    padding: 0;
}

.header{
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

.container{
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.stats-container{
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap: 15px;
    margin-top: 20px;
}

.stat-card{
    background: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.stat-card p{
    font-size: 28px;
    font-weight: bold;
}

.action-bar{
    display:flex;
    justify-content: space-between;
    align-items:center;
    flex-wrap: wrap;
    margin: 25px 0;
    gap: 10px;
}

.add-btn{
    background: #10b981;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
}

table{
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

th{
    background:#0f172a;
    color: white;
    padding: 12px;
}

td{
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.btn-edit{
    background: #f59e0b;
    border: none;
    padding: 6px 10px;
    color: white;
    border-radius: 6px;
}

.btn-delete{
    background: #ef4444;
    border: none;
    padding: 6px 10px;
    color: white;
    border-radius: 6px;
}

.chart-box{
    width: 420px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 12px;
}

.pagination{
    display:flex;
    justify-content:center;
    margin-top:20px;
}
    </style>
</head>

<body>

@php
    $isAdmin = auth()->user()->role === 'admin';
@endphp

<div class="header">
    🎒 Lost & Found System
</div>

<div class="container">

    <!-- STATS -->
    <div class="stats-container">

        <div class="stat-card">
            <h3>Total</h3>
            <p>{{ $totalItems }}</p>
        </div>

        <div class="stat-card">
            <h3>Lost</h3>
            <p>{{ $lostItems }}</p>
        </div>

        <div class="stat-card">
            <h3>Found</h3>
            <p>{{ $foundItems }}</p>
        </div>

        <div class="stat-card">
            <h3>Returned</h3>
            <p>{{ $returnedItems }}</p>
        </div>

    </div>

    <!-- CHART -->
    <div class="chart-box">
        <canvas id="statusChart"></canvas>
    </div>

    <script>
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Lost','Found','Returned'],
            datasets: [{
                data: [
                    {{ $lostItems }},
                    {{ $foundItems }},
                    {{ $returnedItems }}
                ],
                backgroundColor: ['#ef4444','#3b82f6','#22c55e']
            }]
        }
    });
    </script>

    <!-- ACTION BAR -->
    <div class="action-bar">

        <!-- LOGOUT -->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
           class="add-btn"
           style="background:#dc3545;">
            Logout
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>

        <!-- SEARCH -->
        <form method="GET" action="{{ route('items.index') }}">
            <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <div style="display:flex;gap:10px;">

            @if($isAdmin)
            <a href="{{ route('items.export') }}" class="add-btn" style="background:#198754;">
                Export
            </a>

            <a href="{{ route('items.create') }}" class="add-btn">
                Add Item
            </a>

            <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button class="add-btn" style="background:#0d6efd;">Import</button>
            </form>

            <a href="{{ route('items.pdf') }}" class="add-btn" style="background:#dc3545;">
                PDF
            </a>

            <a href="{{ route('items.screenshot') }}" class="add-btn" style="background:#6f42c1;">
                Screenshot
            </a>
            @endif

        </div>
    </div>

    <!-- TABLE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Description</th>
            <th>Location</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Date</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->contact_number }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->date }}</td>

            <td>
                @if($item->image)
                    <img src="{{ asset('images/'.$item->image) }}" width="60">
                @else
                    No Image
                @endif
            </td>

            <td>
                @if($isAdmin)
                    <a href="{{ route('items.edit', $item->id) }}">
                        <button class="btn-edit">Edit</button>
                    </a>

                    <form action="{{ route('items.delete', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Delete</button>
                    </form>
                @else
                    <span style="color:gray;">View Only</span>
                @endif
            </td>
        </tr>
        @endforeach

    </table>

    <!-- PAGINATION -->
    <div class="pagination">
        {{ $items->links() }}
    </div>

</div>

</body>
</html>

