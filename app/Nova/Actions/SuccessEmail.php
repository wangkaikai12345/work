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
//    public function name()
//    {
//        return __('问题解决邮件通知');
//    }

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
            Mail::to($model)->send(new Success($model, $fields->title));

            $this->markAsFinished($model);
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
            Text::make(__('工单问题'),'title')->rules('required'),
        ];
    }


}
