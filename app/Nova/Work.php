<?php

namespace App\Nova;

use App\Nova\Filters\UserOwen;
use Frowhy\NovaFieldQuill\NovaFieldQuill;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;


class Work extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Work';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * 获取资源可以显示的标签.
     *
     * @return string
     */
    public static function label()
    {
        return __('工单列表');
    }

    /**
     * 获取资源可以显示的单标签.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('工单');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('工单标题'),'title')
                ->rules('required', 'max:255'),

            BelongsTo::make(__('提交人'), 'user', User::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make(__('工单类别'), 'type', Type::class)
                ->rules('required'),

            BelongsTo::make(__('工单系统'), 'system', System::class)
                ->rules('required'),

            BelongsTo::make(__('技术处理'), 'love', Love::class)
                ->hideWhenCreating()
                ->searchable(),

            Indicator::make(__('工单状态'), 'status')
                ->labels([
                    'unsolved' => '未解决',
                    'allot' => '已分配',
                    'confirm' => '待确认',
                    'complete' => '已完成',
                ]),

            Select::make(__('工单状态'), 'status')->options([
                'unsolved' => '未解决',
                'allot' => '已分配',
                'confirm' => '待确认',
                'complete' => '已完成',
            ])  ->hideWhenCreating()
                ->hideFromIndex()
                ->hideFromDetail(),

            Select::make(__('工单程度'), 'level')->options([
                'low' => '不急',
                'middle' => '平常',
                'high' => '紧急',
            ])  ->hideFromIndex()
                ->hideFromDetail(),

            Indicator::make(__('工单程度'), 'level')
                ->labels([
                    'low' => '不急',
                    'middle' => '平常',
                    'high' => '紧急',
                ]),

            NovaFieldQuill::make(__('工单内容'),'content')
                ->hideFromIndex(),

            HasMany::make(__('工单评论'), 'comments', Comment::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new UserOwen,
            new Filters\WorkLevel,
            new Filters\WorkStatus,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\SuccessEmail)->canSee(function () {
                return auth()->id() === 1;
            }),
        ];
    }
}
