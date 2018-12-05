<?php

namespace Wangkai\WorkComment;

use Laravel\Nova\ResourceTool;

class WorkComment extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return '工单对话';
    }

    /**
     * Indicates that the Stripe inspector should allow refunds.
     *
     * @return $this
     */
    public function issuesRefunds()
    {
        return $this->withMeta(['issuesRefunds' => true]);
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'work-comment';
    }

}
