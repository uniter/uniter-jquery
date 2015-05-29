<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

namespace Demo\Tests\Component;

use Demo\Component\NavMenuComponent;
use Demo\PhpQuery\CssSelectorMatcher;
use Demo\PhpQuery\PhpQuery;
use Demo\QueryPath\Extension\Event;
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

    /**
     * @var PhpQuery
     */
    private $phpQuery;

    public function setUp()
    {
        $phpQuery = new PhpQuery(new CssSelectorMatcher());
        $this->phpQuery = $phpQuery;

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
        $dom = $phpQuery($html);

        $this->body = $dom->find('body');
        $this->aParagraph = $dom->find('#aParagraph');
        $this->menu = $dom->find('#menu');

        $this->menuItem1 = $dom->find('#menuItem1');
        $this->submenu1 = $dom->find('#submenu1');

        $this->menuItem1_1 = $dom->find('#menuItem1_1');
        $this->submenu1_1 = $dom->find('#submenu1_1');

        $this->menuItem2 = $dom->find('#menuItem2');
        $this->submenu2 = $dom->find('#submenu2');

        $this->component = new NavMenuComponent($phpQuery, $this->body, $this->menu);
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

    public function testDoesntShowSecondMenuItemsSubmenuAfterClickingFirstMenuItem()
    {
        $this->menuItem1->click();

        $this->assertFalse($this->submenu2->hasClass('submenu--visible'));
    }

    public function testStopsPropagationOfClickEventAfterClickingFirstMenuItem()
    {
        $event = new Event('click');

        $this->menuItem1->trigger($event);

        $this->assertTrue($event->isPropagationStopped());
    }

    public function testPreventsDefaultActionOfClickEventAfterClickingFirstMenuItem()
    {
        $event = new Event('click');

        $this->menuItem1->trigger($event);

        $this->assertTrue($event->isDefaultPrevented());
    }

    public function testHidesFirstMenuItemsSubmenuAfterClickingFirstThenSecondMenuItems()
    {
        $this->menuItem1->click();
        $this->menuItem2->click();

        $this->assertFalse($this->submenu1->hasClass('submenu--visible'));
    }

    public function testShowsSecondMenuItemsSubmenuAfterClickingFirstThenSecondMenuItems()
    {
        $this->menuItem1->click();
        $this->menuItem2->click();

        $this->assertTrue($this->submenu2->hasClass('submenu--visible'));
    }

    public function testShowsSubSubmenuAfterClickingFirstMenuItemThenOpeningSubSubmenu()
    {
        $this->menuItem1->click();
        $this->menuItem1_1->click();

        $this->assertTrue($this->submenu1_1->hasClass('submenu--visible'));
    }

    public function testDoesntHideSubSubmenusParentAfterClickingFirstMenuItemThenOpeningSubSubmenu()
    {
        $this->menuItem1->click();
        $this->menuItem1_1->click();

        $this->assertTrue($this->submenu1->hasClass('submenu--visible'));
    }

    public function testHidesSubSubmenuAfterClickingFirstMenuItemThenOpeningSubSubmenuThenClickingOutsideMenu()
    {
        $this->menuItem1->click();
        $this->menuItem1_1->click();
        $this->aParagraph->click();

        $this->assertFalse($this->submenu1_1->hasClass('submenu--visible'));
    }

    public function testHidesSubSubmenusParentMenuAfterClickingFirstMenuItemThenOpeningSubSubmenuThenClickingOutsideMenu()
    {
        $this->menuItem1->click();
        $this->menuItem1_1->click();
        $this->aParagraph->click();

        $this->assertFalse($this->submenu1->hasClass('submenu--visible'));
    }

    public function testHidesFirstMenuItemsSubmenuAfterClickingFirstMenuItemThenClickingOutsideMenu()
    {
        $this->menuItem1->click();
        $this->aParagraph->click();

        $this->assertFalse($this->submenu1->hasClass('submenu--visible'));
    }
}
