<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\Component;

use Demo\PhpQuery\PhpQuery;

class NavMenuComponent
{
    const VISIBLE_CLASS = 'submenu--visible';

    /**
     * @var mixed
     */
    private $body;

    /**
     * @var PhpQuery
     */
    private $jQuery;

    /**
     * @var mixed
     */
    private $menu;

    public function __construct($jQuery, $body, $menu)
    {
        $this->body = $body;
        $this->jQuery = $jQuery;
        $this->menu = $menu;
    }

    public function initialize()
    {
        $component = $this;
        $jQuery = $this->jQuery;
        $openSubmenu = $jQuery();

        $this->menu->on('click', '[data-submenu]', function ($event) use ($component, $jQuery, &$openSubmenu) {
            $selector = $jQuery($this)->data('submenu');
            $submenu = $component->menu->find($selector);

            if ($openSubmenu->length && !$jQuery->contains($openSubmenu->{0}, $submenu->{0})) {
                $openSubmenu->removeClass(self::VISIBLE_CLASS);
            }

            $submenu->addClass(self::VISIBLE_CLASS);
            $openSubmenu = $submenu;

            $event->stopPropagation();
            $event->preventDefault();
        });

        $this->body->click(function () use ($component, $jQuery, &$openSubmenu) {
            // Close all parent submenus of the open one
            $openSubmenu->parents('[data-submenu]')->each(function () use ($component, $jQuery) {
                $selector = $jQuery($this)->data('submenu');
                $submenu = $component->menu->find($selector);

                $submenu->removeClass(self::VISIBLE_CLASS);
            });

            $openSubmenu->removeClass(self::VISIBLE_CLASS);
        });
    }
}
