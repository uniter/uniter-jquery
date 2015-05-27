<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\QueryPath\Extension;

class Event
{
    /**
     * @var boolean
     */
    private $defaultPrevented = false;

    /**
     * @var boolean
     */
    private $propagationStopped = false;

    /**
     * @var string
     */
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function isDefaultPrevented()
    {
        return $this->defaultPrevented;
    }
    
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }
    
    public function preventDefault()
    {
        $this->defaultPrevented = true;
    }
    
    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }
}
