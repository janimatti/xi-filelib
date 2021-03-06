<?php

namespace Xi\Filelib\Publisher;

use Xi\Filelib\Configurator;

/**
 * Abstract convenience publisher base class implementing common methods
 * 
 * @author pekkis
 * @package Xi_Filelib
 *
 */
abstract class AbstractPublisher implements Publisher
{
    public function __construct($options = array())
    {
        \Xi\Filelib\Configurator::setConstructorOptions($this, $options);
    }
    
    
    /**
     * @var \Xi\Filelib\FileLibrary Filelib
     */
    private $_filelib;
    
    /**
     * Sets filelib
     *
     * @param \Xi_Filelib $filelib
     */
    public function setFilelib(\Xi\Filelib\FileLibrary $filelib)
    {
        $this->_filelib = $filelib;
    }

    /**
     * Returns filelib
     *
     * @return \Xi\Filelib\FileLibrary Filelib
     */
    public function getFilelib()
    {
        return $this->_filelib;
    }
    
    
    
    
}