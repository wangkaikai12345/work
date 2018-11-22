<template>
    <div>
        <heading class="mb-6">提交工单使用方法</heading>

        <card class="bg-90 flex flex-col">
            <br><br>
            <p class="text-lg text-white">
                1，进入系统，侧边栏选择<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>
            </p>
            <br><br>
            <p class="text-lg text-white">
                2，点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">新建工单</code>,新建表单页面
            </p>
            <br><br>
            <p class="text-lg text-white">
                3，工单表单
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单类别</code>
                    必填项，工单的类型。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单系统</code>
                    必填项，工单所属的系统。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单程度</code>
                    工单要解决的排期，高,中,低。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单标题</code>
                    必填项，工单解决之后，将以标题发送通知邮件到您的邮箱。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单描述</code>
                    必填项，工单问题的简要描述，有问题的账号（校区、姓名、电话），学员问题提供学员信息（校区、姓名、电话、班期）
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单内容</code>
                    必填项，工单问题的主体，重要的是截图，尽量最详细，以便帮您快速解决问题
                <br><br>
            </p>
            <br><br>
            <p class="text-lg text-white">
                4，工单查询和操作
                <br><br>
                点击侧边栏<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">用户列表</code>
                <br><br>
                搜索自己的用户名或者邮箱，快速定位到自己，点击右侧小眼睛，查看详情，会展示您提交的工单，通过查看状态，了解工单处理信息。
                <br><br>
                如果您收到工单处理完成邮件，请更新待确认状态的工单为已解决。
            </p>
        </card>
        <br><br>
        <heading class="mb-6">解决工单使用方法</heading>

        <card class="bg-90 flex flex-col">
            <br><br>
            <p class="text-white-50% text-lg">
                1,点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>,
                右侧筛选，选择未解决的工单，编辑分配技术人员
            </p>
            <br><br>
            <p class="text-white-50% text-lg">
                2,点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">技术人员</code>,
                右侧小眼睛，查看技术人员的详情，下面会展示分配到你的工单，查看工单详情，解决问题
            </p>
            <br><br>
            <p class="text-white-50% text-lg">
                3,工单解决，选择工单，右侧action执行动作SuccessEmail,发送工单解决成功邮件
            </p>
            <br><br>
            <p class="text-white-50% text-lg">
                4,管理员可增删改查
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">技术人员</code>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单系统</code>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单类别</code>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">用户列表</code>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>
            </p>
            <br><br>
            <p class="text-white-50% text-lg">
                5,管理面板可查看新增用户，新增工单，工单状态比例。
            </p>
        </card>
    </div>
</template>

<script>
export default {
//    created() {
//        axios.get('/nova-vendor/some-tips/endpoint')
//             .then(response => {
//
//                this.from = response.data
//             })
//    },
//    data(){
//        return {
//            from:'www.baidu.com'
//        }
//    }
}
</script>

<style>
/* Scoped Styles */
</style>
