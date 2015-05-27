<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\QueryPath\Extension;

use QueryPath\Extension;
use QueryPath\Query;

class DomDataExtension implements Extension
{
    /**
     * @var mixed
     */
    private static $data = array();

    /**
     * @var Query
     */
    private $qp;

    public function __construct(Query $qp)
    {
        $this->qp = $qp;
    }

    public function data($name, $value = null)
    {
        $first = $this->qp->eq(0);
        $hash = spl_object_hash($first->get(0));

        if (!isset(self::$data[$hash])) {
            self::$data[$hash] = array();

            // Import any data-* attributes and store as element data
            foreach ($first->attr() as $attrName => $attrValue) {
                if (substr($attrName, 0, 5) === 'data-') {
                    self::$data[$hash][substr($attrName, 5)] = $attrValue;
                }
            }
        }

        if ($value === null) {
            return isset(self::$data[$hash][$name]) ?
                self::$data[$hash][$name] :
                null;
        }

        self::$data[$hash][$name] = $value;

        return $this->qp;
    }
}
