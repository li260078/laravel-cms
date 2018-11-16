<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">

    <title>登录</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="{{asset('org/assets')}}/img/illustrations/happiness.svg" alt="..." class="img-fluid">
            </div>

        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                登录
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                欢迎来到英雄联盟
            </p>

            <!-- Form -->
            <form method="post" action="{{route('login')}}">
                @csrf
                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label>邮箱</label>

                    <!-- Input -->
                    <input type="email" name="email" class="form-control" placeholder="请输入邮箱">

                </div>

                <!-- Password -->
                <div class="form-group">

                    <div class="row">
                        <div class="col">

                            <!-- Label -->
                            <label>密码</label>

                        </div>
                        <div class="col-auto">

                            <!-- Help text -->
                            <a href="{{route('passwordreser')}}" class="form-text small text-muted">
                                忘记密码?
                            </a>

                        </div>
                    </div> <!-- / .row -->

                    <!-- Input group -->
                    <div class="input-group input-group-merge">

                        <!-- Input -->
                        <input type="password" name="password" class="form-control form-control-appended" placeholder="请输入密码">

                        <!-- Icon -->
                        <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fe fe-eye"></i>
                  </span>
                        </div>

                    </div>
                </div>


                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1">
                    <label class="form-check-label" for="remember">记住我</label>
                </div>
                <!-- Submit -->

                <button class="mt-3 btn btn-lg btn-block btn-primary  mb-3">
                    登录
                </button>

                <!-- Link -->
                <div class="text-center ">
                    <small class="text-muted text-center ">
                       还没有账号?点击 <a href="{{route('register')}}">注册</a>.
                        <a href="{{route('home.index')}}">返回首页</a>
                    </small>
                </div>

            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->

<!-- JAVASCRIPT
================================================== -->

<!-- Libs JS -->
<script src="{{asset('org/assets')}}/libs/jquery/dist/jquery.min.js"></script>
<script src="{{asset('org/assets')}}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('org/assets')}}/libs/chart.js/dist/Chart.min.js"></script>
<script src="{{asset('org/assets')}}/libs/chart.js/Chart.extension.min.js"></script>
<script src="{{asset('org/assets')}}/libs/highlight/highlight.pack.min.js"></script>
<script src="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="{{asset('org/assets')}}/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="{{asset('org/assets')}}/libs/list.js/dist/list.min.js"></script>
<script src="{{asset('org/assets')}}/libs/quill/dist/quill.min.js"></script>
<script src="{{asset('org/assets')}}/libs/dropzone/dist/min/dropzone.min.js"></script>
<script src="{{asset('org/assets')}}/libs/select2/dist/js/select2.min.js"></script>

<!-- Theme JS -->
<script src="{{asset('org/assets')}}/js/theme.min.js"></script>
@include('layouts.hdjs')
@include('layouts.message')
</body>
</html>