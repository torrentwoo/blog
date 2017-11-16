<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="renderer" content="webkit" />
    <title>Not Found</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400" />
    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 400;
            font-family: 'Montserrat';
        }
        a {
            /*font-weight: 700;*/
        }
        a:link, a:visited {
            color: #5cb85c;
            text-decoration: none;
        }
        a:hover, a:active {
            color: #428bca;
            text-decoration: underline;
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
            font-weight: 700;
            font-size: 36px;
        }
        .link {
            margin: 1em 0 0;
            list-style: none inside none;
            border-top: 2px solid #efefef;
            padding: 0;
        }
        .link li {
            display: inline;
            display: inline-block;
            margin: 1em 2em;
        }
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
            <p>That's all we know.</p>
            <ul class="link">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('help') }}">Help</a></li>
                <li><a href="{{ route('search') }}">Search</a></li>
            </ul>
        </div>
    </div>
</body>
</html>