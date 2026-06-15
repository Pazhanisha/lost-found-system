
<!DOCTYPE html>
<html>
<head>
    <title>Add Lost Item</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f6f9;
        }

        .container{
            width:400px;
            margin:40px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
        }

        input, select{
            width:100%;
            padding:10px;
            margin:8px 0;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:10px;
            background:#0d6efd;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#0b5ed7;
        }

        a{
            display:block;
            text-align:center;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Add Lost Item</h2>

   <form method="POST" action="{{ route('items.report.store') }}"
        @csrf

        <input type="text" name="item_name" placeholder="Item Name" required>

        <input type="text" name="description" placeholder="Description" required>

        <input type="text" name="location" placeholder="Location" required>

        <input type="text" name="contact_number" placeholder="Contact Number" required>

    
        <input type="date" name="date" required>

        <!-- ✅ IMAGE UPLOAD FIELD -->
        <input type="file" name="image">

        <button type="submit">Save Item</button>
    </form>

    <a href="{{ route('items.index') }}">Back to List</a>

</div>

</body>
</html>
