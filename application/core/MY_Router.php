<?php

class MY_Router extends CI_Router
{
    public function set_class($class)
    {
        parent::set_class($this->_rewriteSegment($class));
    }

    public function set_method($method)
    {
        parent::set_method($this->_rewriteSegment($method));
    }

    public function _validate_request($segments)
    {
        foreach ($segments as &$segment) {
            if (!isset($segment)) continue;
            $segment = $this->_rewriteSegment($segment);
        }

        return parent::_validate_request($segments);
    }

    protected function _rewriteSegment($segment)
    {
        return preg_replace_callback('/-\w/', function ($chars) {
            return strtoupper(str_replace('-', '', $chars[0]));
        }, $segment);
    }

}
