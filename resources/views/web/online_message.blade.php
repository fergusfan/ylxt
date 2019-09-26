@extends('layouts.app')

@section('content')

<div class="container profile">
    <div class="row">
        <div class="col-md-8">
            在线问诊<br><br>
            <div id="message" class="message_info" style="font-weight: 400;height: 420px;overflow-y: auto; border-color:#000000;box-shadow: -10px -10px 5px #888888;">
                @foreach($message as $item)
                    @if($item['tell_id']==2)
                        <span><B>{{$item['user']['name']}}:</B></span>
                        &nbsp;&nbsp; &nbsp; &nbsp;  {!! $item['message'] !!}
                     @else
                        <span><B>{{$item['doctor']['name']}}:</B></span>
                        &nbsp;&nbsp; &nbsp; &nbsp;  {!! $item['message'] !!}
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <form class="form" action="/online/message/store/user" method="POST">
                {{ csrf_field() }}
                <input name="room_id" type="hidden" value="{{$room['id']}}">
                <input name="user_id"  type="hidden" value="{{$user['id']}}">
                <input name="doctor_id"   type="hidden" value="{{$doctor['id']}}">
                <input name="message"  type="hidden" id="message_to">
                <div id="editor">
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button  class="btn btn-success float-right" onClick="sumbit()">发送</button>
                    </div>
                </div>
            </form>
            @if($user['user_type']==1)
            <a href="/advice?user_id={{$room['user_id']}}&doctor_id={{$room['doctor_id']}}">回复电子药房</a>
            @endif
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
            document.getElementById('message_to').value=editor.txt.html()
            //this.form.submit(); this.disabled=true;
        }
    </script>
    <script>
        var ele = document.getElementById('message');
        ele.scrollTop = ele.scrollHeight;
    </script>
    <script type="text/javascript">
        $('.select').select2();
    </script>
@endsection
