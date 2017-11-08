<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <title>{{ $headMeta['title'] or 'Demonstration' }}</title>
@if (isset($headMeta['keywords']))
    <meta name="keywords" content="{{ $headMeta['keywords'] }}" />
@endif
@if (isset($headMeta['description']))
    <meta name="description" content="{{ $headMeta['description'] }}" />
@endif
{{--
    <meta name="author" content="torrent, 790896@qq.com" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
--}}
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-3.3.7.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css" />
{{--
    extra control sections via meta definition
--}}
@if (isset($headMeta))
{{-- search engine robots control --}}
@if (isset($headMeta['robots']))
    <meta name="robots" content="{{ $headMeta['robots'] }}" />
@endif
{{-- extra stylesheet, extra style tweaks or third-party stylesheet --}}
@if (isset($headMeta['stylesheets']))
@foreach ($headMeta['stylesheets'] as $stylesheet)
    <link rel="stylesheet" type="text/css" href="{{ $stylesheet }}" />
@endforeach
@endif
{{-- rss feed source --}}
@if (isset($headMeta['feeds']))
@foreach ($headMeta['feeds'] as $feed)
    <link rel="alternate" type="application/rss+xml" href="{{ $feed }}" />
@endforeach
@endif
@endif
</head>
