<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

class ComCfgvideosDispatcherHttp extends ComKoowaDispatcherHttp
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'controller' => 'video',
        ));

        parent::_initialize($config);
    }
}
