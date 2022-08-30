<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        font-family: aozoraminchomedium;
    }
</style>

<body>
    <table class="table table-bordered">
        <tr>
            <th>title</th>
            <th>image</th>
            <th>url</th>
            <th>target</th>
            <th>description</th>
            <th>type</th>
            <th>position</th>
            <th>is_active</th>
        </tr>
        @foreach ($banner as $key => $item)
            <tr class="item-{{ $item->id }}">
                <td>{{ $item->title }}</td>
                <td>
                    {{ data_get($item, 'image') }}
                </td>
                <td>
                    {{ $item->url }}
                </td>
                <td>
                    {{ $item->target }}
                </td>
                <td>
                    {{ config('banner.type')[$item->type] }}
                </td>
                <td>
                    {{ $item->position }}
                </td>
                <td>
                    {{ config('banner.is_active')[$item->is_active] }}
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
