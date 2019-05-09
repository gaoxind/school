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
<div class="container" style="padding-bottom: 50px">
    <h2 class="text-center" style="padding: 50px 0">学生信息列表</h2>
    <table class="table">

        @if($info)
            <tr>
                <td>姓名</td>
                <td>邮箱</td>
                <td>班级</td>
                <td>QQ</td>
                <td>性别</td>
                <td>出生日期</td>
                <td>户籍</td>
                <td>民族</td>
                <td>政治面貌</td>
            </tr>
            <tr>
                <td>
                    {{$info->name}}
                </td>
                <td>
                    {{$info->email}}
                </td>
                <td>
                    {{$classes[$info->userinfo->class]}}
                </td>
                <td>
                    {{$info->userinfo->qq}}
                </td>
                <td>
                    @if($info->userinfo->sex)
                    男
                        @else
                    女
                        @endif
                </td>
                <td>
                    {{$info->userinfo->birth}}
                </td>
                <td>
                    {{$pca[$info->userinfo->census]}}
                </td>
                <td>
                    {{$nations[$info->userinfo->nation]}}
                </td>
                <td>
                    {{$info->userinfo->politics}}
                </td>
            </tr>
        @else
            <tr>
                <td colspan="11">暂无成绩</td>
            </tr>
        @endif

    </table>
</div>

<footer class="navbar-fixed-bottom" style="background-color: #1b1e21">
    <p class="text-center" style="color: white;margin: 0;padding: 20px 0">中国农业大学 版权所有
        ©2017　　校登记号：NW—0201　　文保网安备案号:1101080025　　京ICP备05004632号-1　　联系我们:wlzx@cau.edu.cn</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>