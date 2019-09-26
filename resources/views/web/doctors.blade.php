@extends('layouts.app')

@section('content')
    <div class="container list">
        <div class="row">
            @forelse($list as $item)
                <div style="background-color: rgb(235, 241, 240);width: 360px;float: left;margin: 10px;height:210px;border-radius: 10px">
                <div style="float: left;width: 120px">
                    <img style="float: left; margin:5px;width: 120px !important;" src="{{$item['avatar']}}" class="avatar rounded-circle">
                    <div  style="margin-left:5px;">
                        <a style="font-size: 18px;font-weight: bold;">{{$item['name']}}</a>·{{$item['doctor']['title']}}<br>
                        {{$item['doctor']['department']}}
                    </div>
                </div>
                <div class="col-sm-8 content" style="float: left;padding-top: 10px !important;">
                    <div class="description">
                        <a style="font-weight: bolder">门诊时间：</a>{{$item['doctor']['service_time']}}
                    </div>
                    <div class="description">
                        <a style="font-weight: bold">擅长：</a>
                        {{str_limit($item['doctor']['good_at'],41,'...')}}　　
                    </div>
                    <div class="description">
                        <p id="str1">
                            <a style="font-weight: bold">简介：</a>
                            {{str_limit($item['description'],70,'...') ?? '他什么也不想说，反正他就是个医生'}}　　
                        </p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <a href="/online/message/doctor/{{$item['id']}}" class="btn btn-info btn-sm">在线问诊</a>
                        <a style="background-color: rgb(70, 178, 95)" href="/doctors/question/{{$item['id']}}" class="btn btn-info btn-sm">免费咨询</a>
                    </div>
                    <div class="footer"></div>

                </div>
            </div>
            @empty
                <h3 class="text-center">{{ lang('Nothing') }}</h3>
            @endforelse

        </div>
    </div>
    {{ $list->links('pagination.default') }}

@endsection