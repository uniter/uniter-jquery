<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\Tests\Component;

use Demo\Component\NavMenuComponent;
use PHPUnit_Framework_TestCase;

class NavMenuComponentTest extends PHPUnit_Framework_TestCase
{
    private $aParagraph;
    private $body;
    /**
     * @var NavMenuComponent
     */
    private $component;
    private $menu;
    private $menuItem1;
    private $submenu1;
    private $menuItem1_1;
    private $submenu1_1;
    private $menuItem2;
    private $submenu2;

    public function setUp()
    {
        $html = <<<HTML
<body>
    <p id="aParagraph"></p>
    <ol id="menu">
        <li id="menuItem1" data-submenu="#submenu1">
            <a>Menu 1</a>
            <ol id="submenu1" class="submenu">
                <li id="menuItem1_1" data-submenu="#submenu1_1">
                    <a>Menu 1 sub 1</a>
                    <ol id="submenu1_1" class="submenu">

                    </ol>
                </li>
            </ol>
        </li>
        <li id="menuItem2" data-submenu="#submenu2">
            <a>Menu 2</a>
            <ol id="submenu2" class="submenu"></ol>
        </li>
    </ol>
</body>
HTML;
        $dom = qp($html);

        $this->body = $dom->find('body');
        $this->aParagraph = $dom->find('#aParagraph');
        $this->menu = $dom->find('#menu');

        $this->menuItem1 = $dom->find('#menuItem1');
        $this->submenu1 = $dom->find('#submenu1');

        $this->menuItem1_1 = $dom->find('#menuItem1_1');
        $this->submenu1_1 = $dom->find('#submenu1_1');

        $this->menuItem2 = $dom->find('#menuItem2');
        $this->submenu2 = $dom->find('#submenu2');

        $this->component = new NavMenuComponent('qp', $this->body, $this->menu);
        $this->component->initialize();
    }

    public function testNoVisibleSubmenusBeforeAnythingIsClicked()
    {
        $this->assertSame(0, count($this->menu->find('.submenu.submenu--visible')));
    }

    public function testShowsFirstMenuItemsSubmenuAfterClickingFirstMenuItem()
    {
        $this->menuItem1->click();

        $this->assertTrue($this->submenu1->hasClass('submenu--visible'));
    }
}
