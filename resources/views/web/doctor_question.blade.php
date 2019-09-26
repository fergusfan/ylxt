@extends('layouts.app')

@section('content')
<div class="container profile">
    <div class="row">
        <div class="col-md-2 offset-md-1">
            <img style="float: left; margin:5px;width: 150px !important;" src="{{$user['avatar']}}" class="avatar rounded-circle">
            <div style="text-align: center">
                <a style="font-size: 18px;font-weight: bold;">{{$user['name']}}</a>·{{$user['doctor']['title']}}<br>
                {{$user['doctor']['department']}}
            </div>
        </div>
        <div class="col-md-7">
            <div style="text-align: center">
                <h3>免费咨询</h3>
            </div>
            <form class="form" action="{{ url('discussion') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group row">
                    <input type="hidden"  name="doctor_id" value="{{ $user['id'] }}">
                    <label for="title" class="col-sm-2 col-form-label">咨询的问题</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">相关的标签</label>
                    <div class="col-sm-10">
                        <select class="select{{ $errors->has('tags') ? ' is-invalid' : '' }}" multiple="multiple" name="tags[]" style="width: 100%">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('tags'))
                            <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label">具体内容</label>
                    <div class="col-sm-10">
                        <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" rows="12" name="content">{{ old('content') }}</textarea>

                        @if ($errors->has('content'))
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success float-right" onClick="this.form.submit(); this.disabled=true;">{{ lang('Create Discussion') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.select').select2();
    </script>
@endsection

@section('styles')
    <style>
        .dicussion {
            margin-top: 40px;
        }
    </style>
@endsection
