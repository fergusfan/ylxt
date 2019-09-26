<?php
$discussion = App\Discussion::find($notification->data['id']);
$type = lang('Discussion');
$url = url('discussion', ['id' => $discussion->id??0]);


?>

<li :class="'{{ empty($notification->read_at) }}' ? 'bold' : ''">
    @if ($discussion)
        <a class="text-info" href="{{ url('user', ['username' => $discussion->doctor->name]) }}">{{ $discussion->user->name }}</a>
        咨询你
        <a class="text-info" href="{{ $url }}">{{ $discussion->title }}</a>
    @elseif ($discussion)
        <s>{{ strtolower($type) }} {{ $message }}</s>
    @else
        <s>{{ strtolower($type) }} {{ lang('Deleted') }}</s>
    @endif
</li>
