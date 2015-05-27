<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\QueryPath\Extension;

use DOMNode;
use QueryPath\CSS\DOMTraverser;
use QueryPath\Extension;
use QueryPath\Query;

class DomEventExtension implements Extension
{
    /**
     * @var mixed
     */
    private static $eventHandlers = array();

    /**
     * @var Query
     */
    private $qp;

    public function __construct(Query $qp)
    {
        $this->qp = $qp;
    }

    public function click($callback = null)
    {
        if ($callback === null) {
            return $this->trigger('click');
        }

        return $this->on('click', $callback);
    }

    public function on($eventType, $selector, $callback = null)
    {
        if ($callback === null) {
            $callback = $selector;
            $selector = null;
        }

        foreach ($this->qp as $element) {
            $hash = spl_object_hash($element->get(0));

            if (!isset(self::$eventHandlers[$hash])) {
                self::$eventHandlers[$hash] = array();
            }

            if (!isset(self::$eventHandlers[$hash][$eventType])) {
                self::$eventHandlers[$hash][$eventType] = array();
            }

            self::$eventHandlers[$hash][$eventType][] = array(
                'selector' => $selector,
                'handler' => $callback
            );
        }

        return $this->qp;
    }

    public function trigger($eventType)
    {
        foreach ($this->qp as $element) {
            $event = new Event($eventType);

            $this->triggerEvent($element->get(0), $event);
        }

        return $this->qp;
    }

    private function triggerEvent(DOMNode $node, Event $event, array $triggeredNodes = array())
    {
        $hash = spl_object_hash($node);

        if (isset(self::$eventHandlers[$hash][$event->getType()])) {
            foreach (self::$eventHandlers[$hash][$event->getType()] as $handlerData) {
                $handler = $handlerData['handler'];
                $selector = $handlerData['selector'];

                if ($selector === null) {
                    $boundHandler = $handler->bindTo($node);
                    $boundHandler($event);
                // Delegated handler
                } else {
                    foreach ($triggeredNodes as $triggeredNode) {
                        $matches = $this->matchesSelector($triggeredNode, $selector);

                        if ($matches) {
                            $boundHandler = $handler->bindTo($triggeredNode);
                            $boundHandler($event);

                            if ($event->isDefaultPrevented()) {
                                return;
                            }
                        }
                    }
                }
            }
        }

        if ($node->parentNode) {
            $triggeredNodes[] = $node;
            $this->triggerEvent($node->parentNode, $event, $triggeredNodes);
        }
    }

    private function matchesSelector(DOMNode $node, $selector)
    {
        return qp($node)->is($selector);
    }
}
