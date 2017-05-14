<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

return array(
    'aliases' => array(
        'com://site/cfgvideos.database.table.videos' => 'com://admin/cfgvideos.database.table.videos',
        'com://site/cfgvideos.model.videos' => 'com://admin/cfgvideos.model.videos',
        'com://site/cfgvideos.model.tags' => 'com://admin/cfgvideos.model.tags'
    ),
    'identifiers' => array(
        'com://admin/cfgvideos.database.table.videos' => array(
            'behaviors' => array('com:tags.database.behavior.taggable')
        ),
        'com://site/cfgvideos.model.videos' => array(
            'behaviors' => array('com:tags.model.behavior.taggable')
        )
    )
);
