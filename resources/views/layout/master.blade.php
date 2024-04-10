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
        </div>
    </div>

    <div class="container thistest1">
        <div class="row">
            <div class="col-sm-1 form background_white">
                <ul class="nav nav-pills nav-stacked">
                    @if($page == "admin" && session()->has('user_id'))
                        <!-- 自我介紹 -->
                        <li
                        @if($name == "user")
                            class="active"
                        @endif
                        >
                            <a href="/admin/user">自我介紹</a>
                        </li>
                        <!-- 心情隨筆 -->
                        <li
                        @if($name == "newsfeed")
                            class="active"
                        @endif
                        >
                            <a href="/admin/mind">心情隨筆</a>
                        </li>
                        <!-- 回到前台 -->
                        <li>
                            <a href="/">部落格</a>
                        </li>
                    @else
                    <!-- 首頁 -->
                    <li
                    @if($name == "home")
                        class="active"
                    @endif
                    >
                        <a href="/">部落格</a>
                    </li>
                    @if(session()->has('user_id'))
                        <!-- 自我介紹 -->
                        <li>
                            <a href="/admin/user">進入後台</a>
                        </li>
                    @else
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
                @if(session()->has('user_id'))
                    <!-- 登出 -->
                    <li>
                        <a href="/user/auth/sign-out">登出</a>
                    </li>
                @endif
                </ul>
                <div style="position: absolute; bottom: 1%;"><?php echo date('Y-m-d')?></div>
            </div>
            <div class="col-sm-11 background_white2">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
