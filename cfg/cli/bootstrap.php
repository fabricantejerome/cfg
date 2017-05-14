<?php
/**
 * @package
 * @SubPackage
 * @copyright    Copyright (C) 2015 Magnetic Merchandising Inc. All rights reserved.
 * @license      No License
 * @link        http://magneticmerchandising.com
 */

// Make sure we're being called from the command line, not a web interface
if (array_key_exists('REQUEST_METHOD', $_SERVER)) die();

/**
 * Finder CLI Bootstrap
 *
 * Run the framework bootstrap with a couple of mods based on the script's needs
 */

// We are a valid entry point.
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

// Load system defines
if (file_exists(dirname(dirname(__FILE__)) . '/defines.php')) {
    require_once dirname(dirname(__FILE__)) . '/defines.php';
}

if (!defined('_JDEFINES')) {
    define('JPATH_BASE', dirname(dirname(__FILE__)));
    require_once JPATH_BASE . '/includes/defines.php';
}

// Get the framework.
require_once JPATH_LIBRARIES . '/import.php';

// Bootstrap the CMS libraries.
require_once JPATH_LIBRARIES . '/cms.php';

// Bootstrap the legacy libraries.
#require_once JPATH_LIBRARIES . '/import.php';

// Import necessary classes not handled by the autoloaders
jimport('joomla.application.menu');
jimport('joomla.environment.uri');

jimport('joomla.event.dispatcher');
jimport('joomla.utilities.utility');
jimport('joomla.utilities.arrayhelper');

// needed for some of the components used in the system.
jimport('joomla.application.component.helper');
jimport('joomla.environment.request');

// Import the configuration.
require_once JPATH_CONFIGURATION . '/configuration.php';

// System configuration.
$config = new JConfig;

//error_reporting(E_ALL);
#ini_set('display_errors', 1);


$path = JPATH_LIBRARIES.'/koowa/libraries/koowa.php';
if (file_exists($path)) {
    /**
     * Koowa Bootstrapping
     *
     * If KOOWA is defined assume it was already loaded and bootstrapped
     */
    if (!defined('KOOWA')) {
        require_once $path;

        /**
         * Find Composer Vendor Directory
         */
        $vendor_path = false;
        if (file_exists(JPATH_ROOT . '/composer.json')) {
            $content = file_get_contents(JPATH_ROOT . '/composer.json');
            $composer = json_decode($content);

            if (isset($composer->config->vendor_dir)) {
                $vendor_path = JPATH_ROOT . '/' . $composer->config->vendor_dir;
            } else {
                $vendor_path = JPATH_ROOT . '/vendor';
            }
        }

        /**
         * Framework Bootstrapping
         */
        Koowa::getInstance(array(
            'debug' => false,
            'cache' => false, //JFactory::getApplication()->getCfg('caching')
            'cache_namespace' => 'koowa-cli-' . md5('nothing'),
            'root_path' => JPATH_ROOT,
            'base_path' => JPATH_BASE,
            'vendor_path' => $vendor_path
        ));

        /**
         * Component Bootstrapping
         */
        KObjectManager::getInstance()->getObject('object.bootstrapper')
            ->registerComponents(JPATH_LIBRARIES . '/koowa/components', 'koowa')
            ->registerApplication('site', JPATH_SITE . '/components', false)
            ->registerApplication('admin', JPATH_ADMINISTRATOR . '/components', false)
            ->bootstrap();
    }

    $manager = KObjectManager::getInstance();
    $loader = $manager->getClassLoader();

    //Module Locator
    $loader->registerLocator(new ComKoowaClassLocatorModule(array(
        'namespaces' => array(
            '\\' => JPATH_BASE . '/modules',
            'Koowa' => JPATH_LIBRARIES . '/koowa/modules',
        )
    )));

    /**
     * Module Bootstrapping
     */
    $manager->registerLocator('com:koowa.object.locator.module');

    /**
     * Plugin Bootstrapping
     */
    $loader->registerLocator(new ComKoowaClassLocatorPlugin(array(
        'namespaces' => array(
            '\\' => JPATH_ROOT . '/plugins',
            'Koowa' => JPATH_LIBRARIES . '/koowa/plugins',
        )
    )));

    $manager->registerLocator('com:koowa.object.locator.plugin');

    /**
     * Context Boostrapping
     */

    /**
     * Plugin Bootstrapping
     */
    JPluginHelper::importPlugin('koowa', null, true);
}