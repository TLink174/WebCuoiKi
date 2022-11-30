<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<form action="{{route('admin.categories.update', $category->id)}}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Name" value="{{$category->name}}">
    <input type="text" name="description" placeholder="Description" value="{{$category->description}}">
    <input type="submit" name="submit" value="Create Category" />

</form>
</body>
</html>
