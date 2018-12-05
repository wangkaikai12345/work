<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Success;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class SuccessEmail extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 获取动作显示的名称。
     *
     * @return string
     */
    public function name()
    {
        return '工单解决 邮件通知';
    }

    public function uriKey()
    {
        return 'Success Email';
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //
        foreach ($models as $model) {

            dispatch(new \App\Jobs\SuccessEmail($model));
        }

        return Action::message('发送成功');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [

        ];
    }

}
