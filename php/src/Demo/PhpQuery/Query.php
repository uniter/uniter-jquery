<?php

namespace Demo\PhpQuery;

use Closure;
use Countable;
use DOMNode;
use Exception;
use QueryPath\Query as QueryPathQueryInterface;

class Query implements Countable
{
    /**
     * @var DOMNode|null
     */
    private $context;

    /**
     * @var CssSelectorMatcher
     */
    private $matcher;

    /**
     * @var string
     */
    private $selector;

    /**
     * @var QueryPathQueryInterface
     */
    private $wrappedQuery;

    /**
     * @param CssSelectorMatcher      $matcher
     * @param QueryPathQueryInterface $wrappedQuery
     * @param string|null             $selector
     * @param DOMNode|null            $context
     */
    public function __construct(
        CssSelectorMatcher $matcher,
        QueryPathQueryInterface $wrappedQuery,
        $selector = null,
        DOMNode $context = null
    ) {
        $this->context = $context;
        $this->matcher = $matcher;
        $this->selector = $selector;
        $this->wrappedQuery = $wrappedQuery;
    }

    public function count()
    {
        return count($this->wrappedQuery);
    }

    public function each($callback)
    {
        foreach ($this->wrappedQuery as $index => $item) {
            $node = $item->get(0);

            if ($callback instanceof Closure) {
                $func = $callback->bindTo($node);
            } else {
                $func = $callback;
            }

            $func($index, $node);
        }
    }

    public function parents($selector = null)
    {
        $parents = $this->wrappedQuery->parents();

        if ($selector === null) {
            return $this->createQuery($parents);
        }

        $matchingParents = array();

        foreach ($parents as $parent) {
            if ($this->matcher->matches($parent->get(0), $selector)) {
                $matchingParents[] = $parent->get(0);
            }
        }

        return $this->createQuery(qp($matchingParents));
    }

    /**
     * Handles calls to methods not defined by Query
     * Will delegate to the wrapped QueryPath query
     *
     * @param $method
     * @param $args
     * @return Query|mixed
     */
    public function __call($method, $args)
    {
        if (!is_callable(array($this->wrappedQuery, $method))) {
            throw new Exception('Invalid method call to "' . $method . '"');
        }

        $result = call_user_func_array(
            array($this->wrappedQuery, $method),
            $args
        );

        if ($result instanceof QueryPathQueryInterface) {
            return $this->createQuery($result);
        }

        return $result;
    }

    /**
     * Handles reads of properties not defined by Query
     * Will delegate to the wrapped QueryPath query
     *
     * @param $method
     * @param $args
     * @return Query|mixed
     */
    public function __get($name)
    {
        if (is_numeric($name)) {
            return $this->wrappedQuery->get($name);
        }

        if (!property_exists($this->wrappedQuery, $name)) {
            throw new Exception('Invalid property get "' . $name . '"');
        }

        $result = $this->wrappedQuery->$name;

        if ($result instanceof QueryPathQueryInterface) {
            return $this->createQuery($result);
        }

        return $result;
    }

    private function createQuery(
        QueryPathQueryInterface $wrappedQuery,
        $selector = null,
        $context = null
    ) {
        return new Query($this->matcher, $wrappedQuery, $selector, $context);
    }
}
