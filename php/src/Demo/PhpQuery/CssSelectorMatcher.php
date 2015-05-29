<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\PhpQuery;

use DOMNode;
use QueryPath\CSS\DOMTraverser;
use QueryPath\CSS\Parser;
use QueryPath\CSS\Selector;

class CssSelectorMatcher
{
    /**
     * @param DOMNode $node
     * @param string  $selector
     * @return bool
     * @throws \QueryPath\CSS\ParseException
     */
    public function matches(DOMNode $node, $selector)
    {
        $traverser = new DOMTraverser(new \SPLObjectStorage());

        $handler = new Selector();
        $parser = new Parser($selector, $handler);
        $parser->parse();

        foreach ($handler as $selectorGroup) {
            if ($traverser->matchesSelector($node, $selectorGroup)) {
                return true;
            }
        }

        return false;
    }
}
