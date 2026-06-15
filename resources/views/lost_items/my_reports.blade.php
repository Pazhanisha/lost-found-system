

<!DOCTYPE html>

<html>
<head>
    <title>My Reports</title>

```
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        background:#f4f7fc;
        padding:30px;
    }

    .header{
        background:linear-gradient(135deg,#2563eb,#7c3aed);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:25px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .btn{
        background:white;
        color:#2563eb;
        text-decoration:none;
        padding:12px 20px;
        border-radius:10px;
        font-weight:bold;
    }

    .reports-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
        gap:20px;
    }

    .card{
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
        transition:.3s;
    }

    .card:hover{
        transform:translateY(-5px);
    }

    .image-box{
        height:200px;
        background:#eee;
    }

    .image-box img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .content{
        padding:20px;
    }

    .content h3{
        margin-bottom:10px;
        color:#1e293b;
    }

    .content p{
        margin-bottom:8px;
        color:#64748b;
    }

    .status{
        display:inline-block;
        padding:6px 12px;
        border-radius:20px;
        color:white;
        font-size:14px;
        font-weight:bold;
        margin-top:10px;
    }

    .Lost{
        background:#ef4444;
    }

    .Found{
        background:#22c55e;
    }

    .Returned{
        background:#f59e0b;
    }

    .Pending{
        background:#3b82f6;
    }

    .empty{
        text-align:center;
        padding:50px;
        background:white;
        border-radius:15px;
    }

    .pagination{
        margin-top:30px;
        display:flex;
        justify-content:center;
    }
</style>
```

</head>
<body>

<div class="header">

```
<div>
    <h1>📄 My Reports</h1>
    <p>Track all items you have reported</p>
</div>

<a href="{{ route('items.report') }}" class="btn">
    ➕ Report New Item
</a>
```

</div>

@if($items->count())

<div class="reports-grid">

@foreach($items as $item)

<div class="card">

```
<div class="image-box">

    @if($item->image)
        <img src="{{ asset('images/'.$item->image) }}">
    @else
        <img src="https://via.placeholder.com/400x200?text=No+Image">
    @endif

</div>

<div class="content">

    <h3>{{ $item->item_name }}</h3>

    <p>📍 {{ $item->location }}</p>

    <p>📅 {{ $item->date }}</p>

    <span class="status {{ $item->status }}">
        {{ $item->status }}
    </span>

</div>
```

</div>

@endforeach

</div>

@else

<div class="empty">
    <h2>No Reports Yet</h2>
    <p>You haven't reported any lost items.</p>
</div>

@endif

<div class="pagination">
    {{ $items->links() }}
</div>

</body>
</html>

