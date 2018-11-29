<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkComplete extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        foreach ($models as $model) {
            $model->status = 'complete';
            $model->save();
        }

        return Action::message('操作成功');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }

    /**
     * 获取动作显示的名称。
     *
     * @return string
     */
    public function name()
    {
        return '工单完成';
    }

    public function uriKey()
    {
        return 'Work Complete';
    }

}
