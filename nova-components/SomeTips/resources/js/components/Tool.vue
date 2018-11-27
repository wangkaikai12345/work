<template>
    <div>
        <heading class="mb-6">提交工单使用方法</heading>

        <card class="bg-90 flex flex-col">
            <br><br>
            <p class="text-lg text-white">
                1，进入系统，点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">用户列表</code>，编辑完善邮箱信息！刷新页面！
                （注意：如果您不完善邮箱信息，工单无法新建！邮箱用来接收工单处理实时信息！）
            </p>
            <br><br>
            <p class="text-lg text-white">
                2，侧边栏选择<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>
                点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">新建工单</code>,新建表单页面
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
                    工单要解决的排期，正常，紧急，非常紧急。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单标题</code>
                    必填项，技术管理人员对工单的回复，以及工单解决之后，将以标题为标识发送通知邮件到您的邮箱。
                <br><br>
                <code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单内容</code>
                    必填项，工单问题的主体，工单问题的简要描述，有问题的账号（校区、姓名、电话），学员问题提供学员信息（校区、姓名、电话、班期），重要的是截图！尽量最详细，以便帮您快速解决问题
            </p>
            <br><br>
            <p class="text-lg text-white">
                4，工单查询和操作
                <br><br>
                点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>
                <br><br>
                点击右侧小眼睛，查看详情，会展示您提交的工单，下面会展示工单下的评论，技术人员的回复和您的描述，用来了解工单处理信息。
                <br><br>
                如果的问题已经解决，选中工单，操作 Work Complete。
            </p>
            <br><br>
            <p class="text-lg text-white">
                5，工单问题解决
                <br><br>
                点击<code class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1">工单列表</code>
                <br><br>
                如果的问题已经解决，选中工单，操作 Work Complete,工单完成！
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
                右侧小眼睛，查看技术人员的详情，下面会展示分配到你的工单，查看工单详情，工单评论可邮件通知用户，了解详细信息，用户的评论，将以叮叮方式通知，注意查看！
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
