<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script> --}}

    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
  </head>
  <boby>
    <div class="toolbar_section">
        <span class="toolbar_title">@yield('title')</span>

        <div class="toolbar_right">
            <span class="toolbar_text">
                {{ $User != null ? $User->name."，您好！" : "未登入" }}
            </span>
            <div class="dropdown" style="float: right; margin-right: 1px;">
                <img
                @if (!$User || $User->picture=='')
                    src="/images/gears.png"
                @else
                    src="/{{$User->picture}}"
                @endif
                style="height:60px;" class="btn" data-bs-toggle="dropdown"aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/">回到首頁</a></li>
                @if(session()->has('user_id'))
                    <li><a class="dropdown-item" href="/admin/user">編輯個人資料</a></li>
                    <li><a class="dropdown-item" href="/admin/newsfeed">備忘錄列表</a></li>
                    <hr>
                    <li><a class="dropdown-item" href="/user/auth/sign-out">登出</a></li>
                @else
                    <li><a class="dropdown-item" href="/user/auth/sign-up">註冊</a></li>
                    <hr>
                    <li><a class="dropdown-item" href="/user/auth/sign-in">登入</a></li>
                @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="container thistest1">
        <div class="row">
            <div class="col-sm-2 form background_white">
                <ul class="nav nav-pills nav-stacked">
                    @if ($page== "user")
                        <!-- 首頁 -->
                        <li>
                            組員<h4>{{ $userData->name }}</h4>
                        </li>
                        <!-- 自我介紹 -->
                        <li
                        @if($name == "user")
                            class="active"
                        @endif
                        >
                            <a href="/{{ $userData->id }}/user">組員資料</a>
                        </li>
                        <!-- 隨口說說 -->
                        <li
                        @if($name == "newsfeed")
                            class="active"
                        @endif
                        >
                            <a href="/{{ $userData->id }}/newsfeed">備忘錄列表</a>
                        </li>
                        <hr>
                        <li><a href="/">回到首頁</a></li>
                    @elseif($page== "admin" && session()->has('user_id'))
                        <!-- 自我介紹 -->
                        <li
                        @if($name == "user")
                            class="active"
                        @endif
                        >
                            <a href="/admin/user">編輯個人資料</a>
                        </li>
                        <!-- 隨口說說 -->
                        <li
                        @if($name == "newsfeed")
                            class="active"
                        @endif
                        >
                            <a href="/admin/newsfeed">備忘錄列表</a>
                        </li>
                        <hr>
                        <li><a href="/">回到首頁</a></li>
                    @else
                        <!-- 首頁 -->
                        <li
                        @if($name == "home")
                            class="active"
                        @endif
                        >
                            <a href="/">首頁</a>
                        </li>
                        @if(session()->has('user_id')==false)
                            <!-- 註冊 -->
                            <li
                            @if($name == "sign_up")
                                class="active"
                            @endif
                            >
                                <a href="/user/auth/sign-up">註冊</a>
                            </li>
                            <!-- 登入 -->
                            <li
                            @if($name == "sign_in")
                                class="active"
                            @endif
                            >
                                <a href="/user/auth/sign-in">登入</a>
                            </li>
                        @endif
                    @endif
                </ul>
                <div style="position: absolute; bottom: 1%; left:1%;"><?php echo date('Y-m-d')?></div>
            </div>
            <div class="col-sm-10 background_white2">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
