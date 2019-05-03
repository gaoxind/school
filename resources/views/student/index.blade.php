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
    <h2 class="text-center" style="padding: 50px 0">成绩列表</h2>
    <table class="table">

            @if($course)
            <tr>
                <td>姓名</td>
                <td>专业</td>
                <td>课程1</td>
                <td>成绩</td>
                <td>课程2</td>
                <td>成绩</td>
                <td>课程3</td>
                <td>成绩</td>
                <td>体育成绩</td>
                <td>加分</td>
                <td>减分</td>
                <td>违纪</td>
            </tr>
                <tr>
                    <td>
                        {{$course->user->name}}
                    </td>
                    <td>
                        {{$course->major}}
                    </td>
                    <td>
                        {{$major[$course->courseNameOne]}}
                    </td>
                    <td>
                        {{$course->courseOne}}
                    </td>
                    <td>
                        {{$major[$course->courseNameTwo]}}
                    </td>
                    <td>
                        {{$course->courseTwo}}
                    </td>
                    <td>
                        {{$major[$course->courseNameThree]}}
                    </td>
                    <td>
                        {{$course->courseThree}}
                    </td>
                    <td>
                        {{$course->MoralCourse}}
                    </td>
                    <td>
                        {{$course->addCourse}}
                    </td>
                    <td>
                        {{$course->subCourse}}
                    </td>
                    <td>
                        {{$course->break?'违纪':'无'}}
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