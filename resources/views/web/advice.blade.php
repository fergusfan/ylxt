@extends('layouts.app')

@section('content')
<div class="container profile">
    <div class="row">
        <div class="col-md-2 offset-md-1">

        </div>
        <div class="col-md-7">
            <div style="text-align: center">
                <h3>回复给{{$user->name}}的电子药房 </h3>
            </div>
            <form class="form" action="/advice" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input name="message"   type="hidden" id="message_to">
                        <input name="user_id"  value="{{$_GET['user_id']}}" type="hidden">
                        <input name="doctor_id" value="{{$_GET['doctor_id']}}"  type="hidden">
                        <div id="editor"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button class="btn btn-success float-right"  onClick="sumbit()">{{ lang('Create Discussion') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="//unpkg.com/wangeditor/release/wangEditor.min.js"></script>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#editor')
        // 或者 var editor = new E( document.getElementById('editor') )
        editor.customConfig.uploadImgShowBase64 = true
        editor.customConfig.menus = [
            'head',
            'bold',
            'italic',
            'underline',
            'emoticon',  // 表情
            'image',  // 插入图片
            'table',  // 表格
        ]
        editor.create()
        function sumbit() {
            document.getElementById('message_to').value=editor.txt.html();
            this.form.submit(); //this.disabled=true;
        }
    </script>
@endsection

@section('styles')
    <style>
        .dicussion {
            margin-top: 40px;
        }
    </style>
@endsection
