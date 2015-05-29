<?php

namespace Demo\PhpQuery;

class PhpQuery
{
    /**
     * @var CssSelectorMatcher
     */
    private $matcher;

    public function __construct(CssSelectorMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function __invoke($selector = null, $context = null)
    {
        return new Query($this->matcher, qp($selector), $selector, $context);
    }

    /**
     * @link https://api.jquery.com/jQuery.contains/
     */
    public function contains($container, $contained)
    {
        $node = $contained->parentNode;

        while ($node) {
            if ($node === $container) {
                return true;
            }

            $node = $node->parentNode;
        }

        return false;
    }
}
