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
<h2 class="text-center" style="padding: 50px">奖学金申请</h2>
<div class="container">
    <form class="form-horizontal" method="post" action="{{url('scholarship/form')}}">
        {{csrf_field()}}
        <div class="form-group">
            <la1bel for="inputEmail3" class="col-sm-2 control-label">姓名</la1bel>
            <div class="col-sm-10">
                <input type="text" class="form-control"  value="{{$name}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <la1bel for="inputEmail3" class="col-sm-2 control-label">申请类别</la1bel>
            <div class="col-sm-10">
                <select name="type" id="" class="form-control">
                    @foreach($schol as $key=>$value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">必须课成绩</label>
            <div class="col-sm-10">
                <input type="text" name="required_course" class="form-control" id="inputPassword3" placeholder="必修课成绩">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">选修课成绩</label>
            <div class="col-sm-10">
                <input type="text" name="optional_course" class="form-control" id="inputPassword3" placeholder="选修课成绩">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
</div>


<footer class="" style="background-color: #1b1e21">
    <p class="text-center" style="color: white;margin: 0;padding: 20px 0">中国农业大学 版权所有
        ©2017　　校登记号：NW—0201　　文保网安备案号:1101080025　　京ICP备05004632号-1　　联系我们:wlzx@cau.edu.cn</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>