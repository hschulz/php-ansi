<?php

namespace hschulz\ANSI\Tests;

use \PHPUnit\Framework\TestCase;
use \hschulz\ANSI\Ansi;

/**
 *
 */
final class AnsiTest extends TestCase
{

    const TEST_TEXT = 'Sphinx of black quartz, judge my vow';

    public function testCanSetForegroundColor()
    {

        $ansi = new Ansi();
        $ansi->setForegroundColor(Ansi::FG_CYAN);

        $text = $ansi->formatString(self::TEST_TEXT);

        $expected = Ansi::FG_CYAN . self::TEST_TEXT . Ansi::ANSI_END;

        $this->assertEquals($expected, $text);
    }

    public function testCanSetBackgroundColor()
    {

        $ansi = new Ansi();
        $ansi->setBackgroundColor(Ansi::BG_CYAN);

        $text = $ansi->formatString(self::TEST_TEXT);

        $expected = Ansi::BG_CYAN . self::TEST_TEXT . Ansi::ANSI_END;

        $this->assertEquals($expected, $text);
    }
}
