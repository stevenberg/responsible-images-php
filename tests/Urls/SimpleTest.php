<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Tests\Urls;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Size;

class SimpleTest extends TestCase
{
    protected function setUp()
    {
        $this->maker = new Simple('https://example.com');
    }

    public function test()
    {
        $this->assertEquals(
            'https://example.com/width-100_test.jpg',
            $this->maker->make(
                Name::value('test.jpg'),
                ['width' => Size::value(100)]
            )
        );
    }
}
