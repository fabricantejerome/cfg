<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

class ComCfgvideosControllerTag extends ComTagsControllerTag
{
	protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'editable',
                'persistable'
            ),
            'formats' => array('json'),
            'toolbars' => array(
                'menubar',
                'com:cfgvideos.controller.toolbar.tag'
            )
        ));

        parent::_initialize($config);
    }
}
