<?php
/**
 * This file is part of the tiqr project.
 * 
 * The tiqr project aims to provide an open implementation for 
 * authentication using mobile devices. It was initiated by 
 * SURFnet and developed by Egeniq.
 *
 * More information: http://www.tiqr.org
 *
 * @author Peter Verhage <peter@egeniq.com>
 * 
 * @package tiqr
 *
 * @license New BSD License - See LICENSE file for details.
 *
 * @copyright (C) 2010-2012 SURFnet BV
 */

use Psr\Log\LoggerInterface;

/**
 * Class implementing a factory for user storage encryption.
 *
 * @author peter
 */
class Tiqr_UserStorage_Encryption
{
    /**
     * Get an encryption handler of a certain type (default: 'dummy')
     *
     * @param LoggerInterface $logger
     * @param String $type The type of storage to create. Supported types are 'dummy' (default)
     *                     or any class implementing Tiqr_UserSecretStorage_Encryption_Interface.
     *                     In that case $type should be the full class name.
     * @param array $options The options to pass to the storage instance. See the documentation
     *                       in the Encryption subdirectory for options per type.
     *
     * @return Tiqr_UserSecretStorage_Encryption_Interface
     */
    public static function getEncryption(LoggerInterface $logger, string $type="dummy", array $options=array()): Tiqr_UserSecretStorage_Encryption_Interface
    {
        $logger->info(sprintf('Using %s as UserStorage encryption type', $type));
        switch ($type) {
            case "dummy":
                $instance = new Tiqr_UserSecretStorage_Encryption_Dummy($options);
                break;
            default: 
                $instance = new $type($options);
        }
        
        return $instance;
    }
}
