<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="renderer" content="webkit" />
    <title>Not Found</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:100|Tangerine" />
    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }
        .container {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .content {
            display: inline-block;
            text-align: center;
        }
        .heading {
            margin-bottom: 1em;
            font-family: 'Tangerine';
            font-size: 36px;
        }
        .redirect {}
    </style>
{{--
    @link https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
--}}
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="heading">Not Found</h1>
            <p>The server has not found anything matching the Request-URI. No indication is given of whether the condition is temporary or permanent.</p>
            <p>That's all we know, <a class="redirect" href="{{ route('home') }}" title="Redirect to the homepage">Redirect to the homepage</a>.</p>
        </div>
    </div>
</body>
</html>