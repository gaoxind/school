<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/index/index.css')}}">
</head>
<body>
<img src="{{asset('images/banner.jpg')}}" class="banner" alt="">
{{$menu}}
<div class="container">
    <div class="col-md-4" style="margin-top: 30px">
        @if($auth)
            <div class="jumbotron">
                <h3>登录成功</h3>
                @if($user->type==1)
                    <p>{{$user->name}},你好！你当前的身份为学生，将不展示网站后台，</p>
                @else
                    <p>{{$user->name}},你好！你当前的身份为管理员，将展示网站后台，</p>
                @endif
                <p><a class="btn btn-primary" href="{{route('logout')}}" role="button"
                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">注销</a></p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <div class="jumbotron">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">用户名</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="请输入用户名">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密码</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               placeholder="请输入密码">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <button type="submit" class="btn btn-block btn-success" style="width: 80%;margin: 0 auto">登录</button>
                </form>
            </div>

        @endif
    </div>
    <div class="col-md-8" style="margin-top: 30px">
        <div class="jumbotron">
            <h3 class="text-center">网站通知</h3>
            <p>2019年4月25日上午，“北京大学与五四运动——五四爱国运动100周年纪念
                展”在校史馆开幕。展览由北京大学党委宣传部、校史馆、档案馆联合举办
                ，是改造后重新开放的校史馆的首个专题展览。北京大学党委书记邱水平
                、校长郝平为纪念展剪彩。党委副书记刘玉村，副校长田刚、陈宝剑出席
                开幕式。仪式由党委常委、宣传部部长蒋朗朗主持。</p>
        </div>
    </div>
</div>
<footer style="background-color: #1b1e21">
    <p class="text-center" style="color: white;margin: 0;padding: 20px 0">中国农业大学 版权所有 ©2017　　校登记号：NW—0201　　文保网安备案号:1101080025　　京ICP备05004632号-1　　联系我们:wlzx@cau.edu.cn</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>