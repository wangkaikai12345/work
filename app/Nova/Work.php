<?php

namespace App\Nova;

use App\Nova\Actions\WorkComplete;
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
    public static $group = '工单管理';
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
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','title'
    ];

    /**
     * 获取资源可以显示的标签.
     *
     * @return string
     */
    public static function label()
    {
        return __('我的工单');
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
     *  为给定的资源构建一个“索引”查询。
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->id() === 1) {
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    /**
     * 关联的查询限制
     *
     * @param NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return $this|\Illuminate\Database\Eloquent\Builder
     * @author 王凯
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        if (auth()->id() === 1) {
            return $query;
        }

        return $query->where('user_id', auth()->id());
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
                ->hideWhenCreating(),

            Indicator::make(__('工单状态'), 'status')
                ->labels([
                    'unsolved' => '未解决',
                    'allot' => '已分配',
                    'confirm' => '待确认',
                    'complete' => '已完成',
                ])->colors([
                    'unsolved' => 'red',
                    'allot' => 'grey',
                    'confirm' => 'blue',
                    'complete' => 'green',
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
                'low' => '正常',
                'middle' => '紧急',
                'high' => '非常紧急',
            ])  ->rules('required')
                ->hideFromIndex()
                ->hideFromDetail(),

            Indicator::make(__('工单程度'), 'level')
                ->labels([
                    'low' => '正常',
                    'middle' => '紧急',
                    'high' => '非常紧急',
                ])->colors([
                    'low' => 'green',
                    'middle' => 'orange',
                    'high' => 'red',
                ]),

            NovaFieldQuill::make(__('工单内容'),'content')
                ->rules('required')
                ->hideFromIndex(),

            HasMany::make(__('工单对话'), 'comments', Comment::class)
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
            (new WorkComplete)->canSee(function () {
                return auth()->id() === 1;
            })->canRun(function () {
                return auth()->id() === 1;
            }),
            (new Actions\SuccessEmail)->canSee(function () {
                return auth()->id() === 1;
            })->canRun(function () {
                return auth()->id() === 1;
            }),
        ];
    }
}
