@component('mail::message')
# 通知消息

您提交的【{{$title}}】问题已经解决,请确认！并更新工单状态为已解决！


感谢您的理解和支持！我们会更努力！<br>
{{ config('app.name') }}
@endcomponent
