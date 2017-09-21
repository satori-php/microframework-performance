<?php

declare(strict_types=1);

namespace Site\App;

use Satori\Template\AbstractTemplate;

class LayoutTemplate extends AbstractTemplate
{
    protected $layoutBlock = '/app/layout';

    protected $commonVars = [];
    protected $layoutVars = [];

    protected function init(array $data)
    {
        $siteName = $this->params['site_name'] ?? 'Application';

        $this->commonVars['site'] = $this->params['site'];

        $this->layoutVars['site_name'] = $siteName;
        $this->layoutVars['title'] = $siteName;
        $this->layoutVars['copyright'] = date('Y') . ' ' . $siteName;

    }
}
