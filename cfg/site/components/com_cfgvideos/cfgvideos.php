<?php
/**
 * Cfgvideos - a Joomla example extension built with Nooku Framework.
 *
 */

defined('_JEXEC') or die;

if (!class_exists('Koowa')) {
    return;
}

//Catch exceptions before Joomla does (JApplication::dispatch())
try {
    KObjectManager::getInstance()->getObject('com://site/cfgvideos.dispatcher.http')->dispatch();
} catch(Exception $exception) {
    KObjectManager::getInstance()->getObject('exception.handler')->handleException($exception);
}