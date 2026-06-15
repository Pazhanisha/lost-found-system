
<!DOCTYPE html>
<html>
<head>
    <title>Edit Lost Item</title>

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
        }

        input, select{
            width:100%;
            padding:10px;
            margin:8px 0;
        }

        button{
            width:100%;
            padding:10px;
            background:green;
            color:white;
            border:none;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Edit Item</h2>

<form action="{{ route('items.update', $item->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="item_name" value="{{ $item->item_name }}">

    <input type="text" name="description" value="{{ $item->description }}">

    <input type="text" name="location" value="{{ $item->location }}">

    <input type="text" name="contact_number" value="{{ $item->contact_number }}">

    <select name="status">
        <option value="Lost" {{ $item->status == 'Lost' ? 'selected' : '' }}>Lost</option>
        <option value="Found" {{ $item->status == 'Found' ? 'selected' : '' }}>Found</option>
        <option value="Returned" {{ $item->status == 'Returned' ? 'selected' : '' }}>Returned</option>
    </select>

    <input type="date" name="date" value="{{ $item->date }}">

    <label><strong>Current Image:</strong></label><br>

    @if($item->image)
        <img src="{{ asset('images/'.$item->image) }}"
             width="120"
             style="margin-bottom:10px;border-radius:5px;">
    @else
        <p>No Image Available</p>
    @endif

    <label><strong>Choose New Image:</strong></label>
    <input type="file" name="image">

    <button type="submit">Update Item</button>
</form>
</div>

</body>
</html>
