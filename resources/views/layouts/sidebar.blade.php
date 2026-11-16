<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
                <p><a href="{{ route('top.show') }}"><i class="fas fa-home"></i> マイページ</a></p>
                <p><a href="/logout"><i class="fas fa-sign-out-alt"></i> ログアウト</a></p>
                <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}"><i class="far fa-calendar-alt"></i> スクール予約</a></p>
		@if (Auth::user()->role != 4)
                <p><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}"><i class="far fa-calendar-check"></i> スクール予約確認</a>
                <p><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}"<i class="fas fa-calendar-alt"></i><i class="fas fa-pen" style="font-size: 8px; margin-left: -5px;"></i> スクール枠登録
		@endif
                <p><a href="{{ route('post.show') }}"><svg width="20" height="20" viewBox="0 0 24 24" style="vertical-align:middle"><path d="M3 3h18v15H7l-4 3V3z" fill="white"/><path d="M6 7h12M6 11h12M6 15h9" stroke="#03AAD2" stroke-width="1.5" fill="none"/></svg> 掲示板</a></p>
                <p><a href="{{ route('user.show') }}"><i class="fas fa-user-friends"></i> ユーザー検索</a></p>
            </div>
            <div class="main-container">
                {{ $slot }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
    </body>
</html>
