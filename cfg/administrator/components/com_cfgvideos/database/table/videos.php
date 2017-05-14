<?php
/**
 * Cfgvideos - an extension built with Nooku Framework.
 *
 */

class ComCfgvideosDatabaseTableVideos extends KDatabaseTableAbstract
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'lockable',
                'creatable',
                'modifiable',
                'identifiable',
                'com:tags.database.behavior.taggable',
                //'taggable',
            ),
            'filters' => array(
                'title'        => array('trim'),
                'description'  => array('trim', 'html')
            )
        ));

        parent::_initialize($config);
    }
}
