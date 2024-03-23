<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    @vite(['resources/scss/app.scss'])
  </head>
  <boby>
    <div class="toolbar_section">
        <span class="toolbar_title">@yield('title')</span>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-1 form background_white">
                <ul class="nav nav-pills nav-stacked">
                    <!-- 首頁 -->
                    <li
                    @if($name == "home")
                        class="active"
                    @endif
                    >
                        <a href="/">首頁</a>
                    </li>
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
                    <!-- 登出 -->
                    <li>
                        <a href="/user/auth/sign-out">登出</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-11 background_white2">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
