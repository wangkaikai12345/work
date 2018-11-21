<?php

namespace App\Nova\Metrics;

use App\Work;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class NewWorks extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Work::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            1 => '最近1天',
            30 => '最近30天',
            60 => '最近60天',
            365 => '最近365天',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-works';
    }

    public function name()
    {
        return __('新增工单');
    }
}
