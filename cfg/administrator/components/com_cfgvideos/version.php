<?php
/**
 * @package
 * @SubPackage
 * @copyright   Copyright (C) 2015 Magnetic Merchandising Inc. All rights reserved.
 * @license     No license
 * @link        http://magneticmerchandising.com
 */

class ComCfgvideosVersion extends KObject
{
    const VERSION = '1.0';

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }
}