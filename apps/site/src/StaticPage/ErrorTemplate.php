<?php

declare(strict_types=1);

namespace Site\StaticPage;

use Site\App\LayoutTemplate;
 
class ErrorTemplate extends LayoutTemplate
{
    protected $contentBlock = '/static-page/error';

    protected $contentVars = [];

    protected function init(array $data)
    {
        parent::init($data);

        $code = $data['http_status'];
        $phrase = $data['reason_phrase'];
        $header = sprintf('%s %s', $code, $phrase);

        $this->layoutVars['title'] = $header;

        $this->contentVars['header'] = $header;
        $this->contentVars['phrase'] = $phrase;
        $this->contentVars['content'] = [
            404 => 'The requested resource could not be found.',
            405 => 'This request method is not supported for the requested resource.',
            411 => 'The request did not specify the length of its content.',
            500 => 'The server was unable to process the request.',
        ][$code] ?? '';
        $this->contentVars['error_message'] = $data['error_message'];
    }
}
