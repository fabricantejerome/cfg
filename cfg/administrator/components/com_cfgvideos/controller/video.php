<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

class ComCfgvideosControllerVideo extends ComKoowaControllerModel
{
    protected function _initialize(KObjectConfig $config)
    {
    	$config->append(array(
    		'behaviors' => array(
    			'com:tags.controller.behavior.taggable'
    		)
    	));

    	parent::_initialize($config);
    }
}