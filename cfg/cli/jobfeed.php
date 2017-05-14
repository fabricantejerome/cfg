<?php
/**
 * @package
 * @SubPackage
 * @copyright    Copyright (C) 2015 Magnetic Merchandising Inc. All rights reserved.
 * @license      No License
 * @link        http://magneticmerchandising.com
 */

include_once dirname(__FILE__) . '/bootstrap.php';

class CliJobfeed extends JApplicationCli
{

    protected $_manager;

    public function __construct($input = null, JRegistry $config = null, JEventDispatcher $dispatcher = null)
    {

        $this->_manager = KObjectManager::getInstance();

        // overriding the parent right now because the server was killing this because of a STDIN error (not tty). REMOVE THIS WHEN I FIGURE OUT THE PROBLEM. 
        // Close the application if we are not executed from the command line.
        // @codeCoverageIgnoreStart
        if (!defined('STDOUT') || !defined('STDIN') || !isset($_SERVER['argv']))
        {
        //    $this->close();
        }
        // @codeCoverageIgnoreEnd

        // If an input object is given use it.
        if ($input instanceof JInput)
        {
            $this->input = $input;
        }
        // Create the input based on the application logic.
        else
        {
            if (class_exists('JInput'))
            {
                $this->input = new JInputCli;
            }
        }

        // If a config object is given use it.
        if ($config instanceof Registry)
        {
            $this->config = $config;
        }
        // Instantiate a new configuration object.
        else
        {
            $this->config = new Registry;
        }

        $this->loadDispatcher($dispatcher);

        // Load the configuration object.
        $this->loadConfiguration($this->fetchConfigurationData());

        // Set the execution datetime and timestamp;
        $this->set('execution.datetime', gmdate('Y-m-d H:i:s'));
        $this->set('execution.timestamp', time());

        // Set the current directory.
        $this->set('cwd', getcwd());
    }

    /**
     * Pass through to KObjectManager::getObject.
     * @param $identifier
     * @param array $config
     * @return KObjectInterface
     * @since 2017
     */
    protected function getObject($identifier, $config = array())
    {
        return $this->_manager->getObject($identifier, $config);
    }

    protected function doExecute()
    {
        // use $this->input->get to set some cli params, i.e. feed ids, names, etc.
        $this->getObject('com://admin/cfgjobs.controller.feed', array('behaviors' => array()))->active(1)->process();

    }

    public function getCfg($varname, $default = null)
    {
        return $this->get($varname, $default);
    }

}

$app = JApplicationCli::getInstance('CliJobfeed');
// strap the application
JFactory::$application = $app;

$app->execute();