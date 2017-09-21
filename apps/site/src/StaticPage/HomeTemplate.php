<?php

declare(strict_types=1);

namespace Site\StaticPage;

use Site\App\LayoutTemplate;
 
class HomeTemplate extends LayoutTemplate
{
    protected $contentBlock = '/static-page/home';

    protected $contentVars = [];

    protected function init(array $data)
    {
        parent::init($data);

        $header = 'Home';

        $this->layoutVars['title'] = $header;

        $this->contentVars['header'] = $header;
    }
}
