@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 50px;">
            <div class="well">
                <form class="form" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <fieldset>
                        <legend class="text-center">注册</legend>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="name" class="control-label">用户名</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{ old('name') }}" placeholder="Please input your name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">电话</label>
                                <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                       value="{{ old('phone') }}" placeholder="Please input your phone" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">邮箱</label>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ old('email') }}" placeholder="Please input your email" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="password" class="control-label">密码</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" placeholder="Please input your password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="password-confirm" class="control-label">确认密码</label>

                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation')
                                ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Please confirm your password" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <label for="password-confirm" class="control-label">用户类型</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                普通用户
                                <input id="password-confirm" type="radio"  onclick="show(this)"  name="user_type" value="0" required>
                                医生
                                <input id="password-confirm" type="radio"  onclick="show(this)"  name="user_type" value="1" required>

                            </div>
                        </div>


                        <div class="form-group" style="display: none" id="doc1">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">医院科室</label>
                                <input  class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department"
                                        value="{{ old('department') }}" placeholder="Please input your hospital departments">
                            </div>
                        </div>

                        <div class="form-group"  style="display: none" id="doc2">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">职称</label>
                                <input  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                        value="{{ old('title') }}" placeholder="Please input your title">
                            </div>
                        </div>

                        <div class="form-group"  style="display: none" id="doc3">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">门诊时间</label>
                                <input  class="form-control{{ $errors->has('service_time') ? ' is-invalid' : '' }}"
                                        name="service_time" value="{{ old('service_time') }}" placeholder="Please input your service time">
                            </div>
                        </div>

                        <div class="form-group"  style="display: none" id="doc4">
                            <div class="col-md-10 offset-md-1">
                                <label for="email" class="control-label">擅长领域</label>
                                <input  class="form-control{{ $errors->has('good_at') ? ' is-invalid' : '' }}"
                                        name="good_at" value="{{ old('good_at') }}" placeholder="Please input your good at">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 offset-md-1">
                                <button type="submit" class="btn btn-primary form-control">
                                    注册
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 offset-md-2 text-center">
                                <a class="btn btn-link" href="{{ url('/login') }}">
                                   已经有账号了？点击这里
                                </a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function show(val) {
        var doctors1 = document.getElementById('doc1')
        var doctors2 = document.getElementById('doc2')
        var doctors3 = document.getElementById('doc3')
        var doctors4 = document.getElementById('doc4')
        if(val.value == 1){
            doctors1.style.display="block";
            doctors2.style.display="block";
            doctors3.style.display="block";
            doctors4.style.display="block";
        }else {
            doctors1.style.display="none";
            doctors2.style.display="none";
            doctors3.style.display="none";
            doctors4.style.display="none";
        }
    }
</script>
@endsection
