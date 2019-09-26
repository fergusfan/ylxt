@extends('layouts.app')

@section('content')
    <div class="container list">
        <div class="row">
            @forelse($list as $item)
                <a href="/drug/{{$item['id']}}">
                    <div style="background-color: rgb(235, 241, 240);width: 160px;float: left;margin: 10px;height:210px;border-radius: 10px">
                    <div style="float: left;width: 120px">
                            <img style="float: left; margin:5px;width: 150px !important; height: 90px;" src="{{$item['img']}}" class="avatar">
                            <div  style="margin-left:5px;width: 160px;">
                                <a style="font-size: 18px;font-weight: bold;">{{$item['name']}}</a>·￥{{$item['price']}}<br>
                                {{$item['doctor']['department']}}
                            </div>
                            <div  style="margin-left:5px;width: 155px;">
                                <b>说明：</b>{{str_limit($item['description'],30,'...') ?? ''}}　　
                            </div>
                    </div>

            </div> </a>
            @empty
                <h3 class="text-center">{{ lang('Nothing') }}</h3>
            @endforelse

        </div>
    </div>
    {{ $list->links('pagination.default') }}

@endsection