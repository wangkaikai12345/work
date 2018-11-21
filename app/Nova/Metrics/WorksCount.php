<?php

namespace App\Nova\Metrics;

use App\Work;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class WorksCount extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->result([
            '未解决' => Work::whereStatus('unsolved')->count(),
            '已分配' => Work::whereStatus('allot')->count(),
            '待确认' => Work::whereStatus('confirm')->count(),
            '已解决' => Work::whereStatus('complete')->count(),
        ]);
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
        return 'works-count';
    }

    public function name()
    {
        return __('工单统计');
    }
}
