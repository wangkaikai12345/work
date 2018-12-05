<template>
    <loading-view :loading="loading">
        <h3 style="margin-bottom:20px;float: right;width: 100%;">
            <a :href="'/admin/resources/works/' + work_id" class="btn btn-default btn-primary" v-if="this.resourceName == 'comments'">返回工单详情</a>
            <a :href="'/admin/resources/comments/new?viaResource=works&viaResourceId='+work_id+'&viaRelationship=comments'"
               class="btn btn-default btn-primary" dusk="create-button" style="float: right;"
            > 新建对话  </a>
        </h3>

        <div v-for="messageList in records" style="clear: both;">
            <div v-if="messageList.right==false">
                <div class="pc-service">
                    <div class="pc-service-right"><p><label>{{messageList.user_name}}</label><span>{{messageList.created_at}}</span></p>
                        <div class="pc-service-info" style="">
                            <div v-html="messageList.content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="pc-customer"><p><label>{{messageList.user_name}}</label><span>{{messageList.created_at}}</span></p>
                    <div class="pc-customer-info">
                        <div v-html="messageList.content"></div>
                    </div>
                </div>
            </div>
        </div>
    </loading-view>
</template>

<script>

    export default {
        props: ['resourceName', 'resourceId', 'field'],

        data(){
            return {
                loading: true,
                work_id: 0,
                records: [{
                    right: false,
                    user_name: '管理员',
                    created_at: new Date().toLocaleTimeString(),
                    content: '您好！欢迎来到工单客服，请问有什么能帮到您？如有疑问请在线咨询！感谢您的支持! '
                }],
            }
        },

        created() {
        　
            axios.get('/nova-vendor/work-comment/'+this.resourceId+'?resource='+this.resourceName)
                .then(response => {
                    if (response.data.length) {
                        this.records = response.data;

                        if (this.resourceName == 'comments') {
                            this.work_id = response.data[0].work_id
                        }
                    }

                    if (this.resourceName == 'works') {
                        this.work_id = this.resourceId
                    }

                    this.loading = false;
                })
        },
    }
</script>

<style>
    #pcWrap .pc-visitor-footer .function-bar .svgWrap,
    #pcWrap .pc-visitor-footer .function-bar .imgWrap {
        height: 100%;
    }

    #pcWrap .pc-visitor-footer .function-bar .svgWrap svg,
    #pcWrap .pc-visitor-footer .function-bar .imgWrap span {
        display: inline-block;
        width: 24px;
        height: 24px;
        margin-right: 8px;
        cursor: pointer;
    }

    #pcWrap .pc-visitor-footer .function-bar .imgWrap {
        display: none;
    }

    #pcWrap .pc-visitor-footer .function-bar .imgWrap span {
        background-repeat: no-repeat;
        background-position: left top;
    }

    #pcWrap .pc-visitor-footer .function-bar .imgWrap span:hover {
        background-position: right top;
    }

    #pcWrap .pc-visitor-footer .function-bar .imgWrap span.disabled:hover {
        background-position: left top;
    }

    #pcWrap .pc-visitor-footer .function-bar .imgWrap label.active span {
        background-position: right top;
    }

    /* #pcWrap .pc-visitor-footer .function-bar .imgWrap .active span.icon-hot {background-position: right top;} */


    #pcWrap .pc-visitor-footer .function-bar .svgWrap svg:hover .svgColor {
        fill: #1F8CEB;
    }

    #pcWrap .pc-visitor-footer .function-bar .svgWrap .disabled svg:hover .svgColor {
        fill: #8FA1B3;
    }

    #pcWrap .pc-visitor-footer .function-bar .svgWrap svg.evaluation-icon:hover .svgStroke {
        stroke: #1F8CEB;
    }

    #pcWrap .pc-visitor-footer .function-bar .svgWrap .disabled svg.evaluation-icon:hover .svgStroke {
        stroke: #8FA1B3;
    }

    #pcWrap .pc-visitor-footer .function-bar .talk-function-bar {
        height: 100%;
        width: 100%;
        padding-top: 8px;
    }

    #pcWrap .pc-visitor-footer .function-bar .robot-function-bar {
        height: 100%;
        width: 100%;
        font-size: 12px;
        line-height: 38px;
        display: none;
    }

    #pcWrap .pc-visitor-footer .function-bar .robotLinkTo {
        display: inline-block;
        height: 24px;
        line-height: 24px;
        padding-left: 24px;
        cursor: pointer;
        margin-right: 10px;
    }

    #pcWrap .pc-visitor-footer .function-bar .robotLinkTo:hover {
        color: #1F8CEB;
    }


    .pc-service {
        white-space: nowrap;
        margin-bottom: 15px;
        position: relative;
        max-width: 100%;
    }

    .pc-service:after {
        content: "";
        display: block;
        clear: both;
    }

    .pc-service > img {
        width: 30px;
        height: 30px;
        margin-right: 8px;
        display: inline-block;
        vertical-align: top;
    }

    .pc-service-left {
        display: inline-block;
        height: 100%;
        vertical-align: top;
        width: 48px;
        position: absolute;
        left: 0;
        top: 0;
    }

    .pc-service-left > img {
        width: 40px;
        height: 40px;
        border-radius: 20px;
    }

    .pc-service-right {
        padding-left: 48px;
        padding-right: 38px;
        max-width: 100%;
    }

    .pc-service-right > p {
        font-size: 12px;
        color: #62778C;
        margin-bottom: 5px;
    }

    .pc-service-right > p label {
        margin-right: 10px;
    }

    .pc-service-info {
        white-space: normal;
        display: inline-block;
        padding: 10px 8px;
        background-color: #eff3f6;
        color: #28334B;
        border-radius: 4px;
        max-width: 100%;
        font-size: 13px;
        word-break: break-word;
        word-wrap: break-word;
    }

    .pc-service-info img {
        cursor: zoom-in;
        cursor: -webkit-zoom-in;
        vertical-align: middle;
        margin: 0 2px;
    }

    .pc-time, .system-remind {
        text-align: center;
        margin-bottom: 15px;
        padding-left: 40px;
        padding-right: 40px;
    }

    .system-remind a {
        margin: 0 5px;
    }

    .pc-time label {
        display: inline-block;
        padding: 5px 10px;
        font-size: 12px;
        color: #8DA2B5;
    }

    .pc-customer {
        margin-bottom: 15px;
        max-width: 100%;
        padding-left: 38px;
    }

    .pc-customer > p > label {
        margin-right: 10px;
    }

    .pc-customer.hasAvatar {
        padding-right: 38px;
        background-position: right top;
        background-repeat: no-repeat;
    }

    .pc-customer:after {
        content: "";
        display: block;
        clear: both;
    }

    .pc-customer > p {
        text-align: right;
        font-size: 12px;
        color: #62778C;
        margin-bottom: 5px;
    }

    .pc-customer-info {
        position: relative;
        float: right;
        max-width: 100%;
        padding: 11px 8px;
        border-radius: 4px;
        font-size: 13px;
        background-color: #eff3f6;
        color: #28334B;
        word-break: break-word;
        word-wrap: break-word;
    }

</style>