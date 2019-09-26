@extends('layouts.app')

@section('content')
<div class="container profile">
    <div class="row">
        <div class="col-md-2 offset-md-1">

        </div>
        <div class="col-md-7">
            <div style="text-align: center">
                <h3>挂号</h3>
            </div>
            <form class="form" action="/order" method="GET">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">时间</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="order_time" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">挂号科室</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="department" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label">病情描述</label>
                    <div class="col-sm-10">
                        <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" rows="12" name="description" required>{{ old('content') }}</textarea>

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
