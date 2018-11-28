@component('mail::message')
# 通知消息

您提交的【{{$title}}】问题,技术人员对工单做出了最新评论，请尽快回复！

@component('mail::button', ['url' => $url , 'color' => 'green'])
    点击查看
@endcomponent

感谢您的理解和支持！我们会更努力！<br>
{{ config('app.name') }}
@endcomponent
