<?php
/**
 * Cfgvideos - an extension built with Nooku Framework.
 *
 */

defined('_JEXEC') or die;

if (!class_exists('Koowa'))
{
    if (!JPluginHelper::isEnabled('system', 'koowa')) {
        $error = 'This extension requires \'Nooku Framework\' to be installed and enabled';
    }

    return JFactory::getApplication()->redirect(JURI::base(), $error, 'error');
}

//Catch exceptions before Joomla does (JApplication::dispatch())
try {
    KObjectManager::getInstance()->getObject('com://admin/cfgvideos.dispatcher.http')->dispatch();
} catch(Exception $exception) {
    KObjectManager::getInstance()->getObject('exception.handler')->handleException($exception);
}