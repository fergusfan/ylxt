@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4" style="background-color: rgb(235, 241, 240);">
                <div class="col-md-6" style="text-align: center">
                    <div style="float: left;width: 200px">
                        <img style="float: left; margin:5px;width: 300px !important; height: 200px;" src="{{$item['img']}}" class="avatar">
                        {{--<a style="font-size: 18px;font-weight: bold;">{{$item['name']}}</a>·￥{{$item['price']}}<br>--}}
                        {{$item['doctor']['department']}}
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="background-color: rgb(235, 241, 240);">
                <div  style="margin-left:5px;">
                    <b>产品名称：</b>{{$item['name']}}<br>
                    <b>产品类别：</b>{{$item['type']}}<br>　
                    <b>供应商：</b>{{$item['provider']}}<br>　
                    <b>成   分：</b>{{$item['has']}}<br>　
                    <b>用法用量：</b>{{$item['use']}}<br>　
                    <b>产品价格：</b>{{$item['price']}}<br>
                    <b>主治功能：</b>{{$item['description']}}<br>　
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection