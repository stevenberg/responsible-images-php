<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests\Urls;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Urls\Maker;
use StevenBerg\ResponsibleImages\Urls\Simple;

class MakerTest extends TestCase
{
    public function testDefaultMakerWithNoneRegistered(): void
    {
        $this->expectException(\RuntimeException::class);

        Maker::defaultMaker();
    }

    public function testDefaultMaker(): void
    {
        $simple = new Simple('https://example.com');

        Maker::registerDefaultMaker($simple);

        $this->assertEquals(
            $simple,
            Maker::defaultMaker(),
        );
    }
}
