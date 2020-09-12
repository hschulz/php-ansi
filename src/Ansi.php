<?php

declare(strict_types=1);

namespace Hschulz\ANSI;

/**
 * This class provides the ability to format strings with ANSI escape codes.
 */
class Ansi
{
    // <editor-fold defaultstate="collapsed" desc="Color constants">

    /**
     * Black background color.
     * @var string
     */
    public const BG_BLACK = "\033[40m";

    /**
     * Red background color.
     * @var string
     */
    public const BG_RED = "\033[41m";

    /**
     * Green background color.
     * @var string
     */
    public const BG_GREEN = "\033[42m";

    /**
     * Yellow background color.
     * @var string
     */
    public const BG_YELLOW = "\033[43m";

    /**
     * Blue background color.
     * @var string
     */
    public const BG_BLUE = "\033[44m";

    /**
     * Magenta background color.
     * @var string
     */
    public const BG_MAGENTA = "\033[45m";

    /**
     * Cyan background color.
     * @var string
     */
    public const BG_CYAN = "\033[46m";

    /**
     * Light gray background color.
     * @var string
     */
    public const BG_LIGHT_GRAY = "\033[47m";

    /**
     * Black font color.
     * @var string
     */
    public const FG_BLACK = "\033[0;30m";

    /**
     * Dark grey font color.
     * @var string
     */
    public const FG_DARK_GREY = "\033[1;30m";

    /**
     * Blue font color.
     * @var string
     */
    public const FG_BLUE = "\033[0;34m";

    /**
     * Light blue font color.
     * @var string
     */
    public const FG_LIGHT_BLUE = "\033[1;34m";

    /**
     * Green font color.
     * @var string
     */
    public const FG_GREEN = "\033[0;32m";

    /**
     * Light green font color.
     * @var string
     */
    public const FG_LIGHT_GREEN = "\033[1;32m";

    /**
     * Cyan font color.
     * @var string
     */
    public const FG_CYAN = "\033[0;36m";

    /**
     * Light cyan font color.
     * @var string
     */
    public const FG_LIGHT_CYAN = "\033[1;36m";

    /**
     * Red font color.
     * @var string
     */
    public const FG_RED = "\033[0;31m";

    /**
     * Light red font color.
     * @var string
     */
    public const FG_LIGHT_RED = "\033[1;31m";

    /**
     * Purple font color.
     * @var string
     */
    public const FG_PURPLE = "\033[0;35m";

    /**
     * Light purple font color.
     * @var string
     */
    public const FG_LIGHT_PURPLE = "\033[1;35m";

    /**
     * Brown font color.
     * @var string
     */
    public const FG_BROWN = "\033[0;33m";

    /**
     * Yellow font color.
     * @var string
     */
    public const FG_YELLOW = "\033[1;33m";

    /**
     * Light grey font color.
     * @var string
     */
    public const FG_LIGHT_GREY = "\033[0;37m";

    /**
     * White font color.
     * @var string
     */
    public const FG_WHITE = "\033[1;37m";

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Control constants">

    /**
     * Escape code to end ANSI formatting.
     * @var string
     */
    public const ANSI_END = "\033[0m";

    /**
     * Escape code for bold text.
     * @var string
     */
    public const ANSI_BOLD = "\033[1m";

    /**
     * Escape code for italic text.
     * @var string
     */
    public const ANSI_ITALIC = "\033[3m";

    /**
     * Escape code to underline text.
     * @var string
     */
    public const ANSI_UNDERLINE = "\033[4m";

    /**
     * Escape code to make text blink.
     * @var string
     */
    public const ANSI_BLINK = "\033[5m";

    /**
     * Escape code to switch foreground and background color of text.
     * @var string
     */
    public const ANSI_INVERSE = "\033[7m";

    /**
     * Escape code to hide text.
     * @var string
     */
    public const ANSI_HIDDEN = "\033[8m";

    // </editor-fold>

    /**
     * Indicates whether the escaped string should end all ANSI sequences.
     * @var bool
     */
    protected bool $shouldEnd = true;

    /**
     * Stores all escape sequences.
     * @var array
     */
    protected array $options = [];

    /**
     * Initializes the object.
     */
    public function __construct()
    {
        $this->shouldEnd = true;
        $this->options   = [];
    }

    /**
     * Sets the foreground color.
     *
     * @param string $foregroundColor
     * @return void
     */
    public function setForegroundColor(string $foregroundColor): void
    {
        $this->options['fg_color'] = $foregroundColor;
    }

    /**
     * Sets the background color.
     *
     * @param string $backgroundColor
     * @return void
     */
    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->options['bg_color'] = $backgroundColor;
    }

    /**
     * Switches whether the formatted string should be displayed bold.
     *
     * @param bool $isBold
     * @return void
     */
    public function setBold(bool $isBold): void
    {
        $this->options['bold'] = $isBold ? self::ANSI_BOLD : '';
    }

    /**
     * Switches whether the formatted string should be displayed italic.
     *
     * @param bool $isItalic
     * @return void
     */
    public function setItalic(bool $isItalic): void
    {
        $this->options['italic'] = ((bool) $isItalic) ? self::ANSI_ITALIC : '';
    }

    /**
     * Switches whether the formatted string should be displayed underlined.
     *
     * @param bool $isUnderlined
     * @return void
     */
    public function setUnderlined(bool $isUnderlined): void
    {
        $this->options['underlined'] = ((bool) $isUnderlined) ? self::ANSI_UNDERLINE : '';
    }

    /**
     * Switches whether the formatted string should blink.
     *
     * @param bool $isBlinking
     * @return void
     */
    public function setBlinking(bool $isBlinking): void
    {
        $this->options['blink'] = $isBlinking ? self::ANSI_BLINK : '';
    }

    /**
     * Switches the fore- and background colors.
     *
     * @param bool $isInverse
     * @return void
     */
    public function setInverse(bool $isInverse): void
    {
        $this->options['inverse'] = $isInverse ? self::ANSI_INVERSE : '';
    }

    /**
     * Switches whether the string should be hidden.
     *
     * @param bool $isHidden
     * @return void
     */
    public function setHidden(bool $isHidden): void
    {
        $this->options['hide'] = $isHidden ? self::ANSI_HIDDEN : '';
    }

    /**
     * Switches the automatic appending of the ANSI escape sequence for ending
     * all ANSI formatting to the string.
     *
     * @param bool $shouldEnd
     * @return void
     */
    public function shouldEnd(bool $shouldEnd = true): void
    {
        $this->shouldEnd = $shouldEnd;
    }

    /**
     * Returns an ANSI formatted string.
     *
     * @param string $string The string to format
     * @return string The formatted string
     */
    public function formatString(string $string): string
    {
        $end = ($this->shouldEnd) ? self::ANSI_END : '';
        return implode('', $this->options) . $string . $end;
    }
}
