<?php

declare(strict_types=1);

namespace Hschulz\ANSI;

/**
 *
 */
class Cursor
{
    /**
     * Contains the complete set of operations.
     * @var string
     */
    protected string $sequence = '';

    /**
     * Creates a new instance of the object. You can provide a sequence of
     * ANSI escape codes to initalize the object optionally.
     *
     * @param string $sequence A sequence of ANSI escape codes
     */
    public function __construct(string $sequence = '')
    {
        $this->sequence = $sequence;
    }

    /**
     * Moves the cursor to the specified coordinates. If no parameters are given
     * the cursor will move to the 0,0 position on the screen.
     *
     * @param int $x The new x position
     * @param int $y The new y position
     * @return void
     */
    public function moveTo(int $x = 0, int $y = 0): void
    {
        $this->sequence .= "\033[" . $x . ';' . $y . 'H';
    }

    /**
     * Moves the cursors position up for the given lines. If no value is given
     * the cursor will be moved up one line.
     * The cursors position in the new line will be the same as before.
     *
     * @param int $value The number of lines to move up
     */
    public function up(int $value = 0): void
    {
        $this->sequence .= "\033[" . $value . 'A';
    }

    /**
     * Moves the cursors position down for the given lines. If no value is given
     * the cursor will be moved down one line.
     * The cursors position in the new line will be the same as before.
     *
     * @param int $value The number of lines to move down
     * @return void
     */
    public function down(int $value = 0): void
    {
        $this->sequence .= "\033[" . $value . 'B';
    }

    /**
     * Moves the cursors position to the right for the given amount.
     *
     * @param int $value The increment
     * @return void
     */
    public function forward(int $value = 0): void
    {
        $this->sequence .= "\033[" . $value . 'C';
    }

    /**
     * Moves the cursors position to the left for the given amount.
     *
     * @param int $value The increment
     * @return void
     */
    public function backward(int $value = 0): void
    {
        $this->sequence .= "\033[" . $value . 'D';
    }

    /**
     * Saves the current cursors position.
     * <i>This method will execute immediately instead of waiting for the
     * execute() method.</i>
     *
     * @return void
     */
    public function savePosition(): void
    {
        echo "\033[s";
    }

    /**
     * Restores the saved position of the cursor.
     * <i>This method will execute immediately instead of waiting for the
     * execute() method.</i>
     *
     * @return void
     */
    public function restorePosition(): void
    {
        echo "\033[u";
    }

    /**
     *
     * @return void
     */
    public function eraseDisplay(): void
    {
        $this->sequence .= "\033[2J";
    }

    /**
     *
     * @return void
     */
    public function eraseCurrentLine(): void
    {
        $this->sequence .= "\033[K";
    }

    /**
     *
     * @return void
     */
    public function execute(): void
    {
        echo $this->sequence;
        $this->sequence = '';
    }

    /**
     *
     * @return string A sequence of ANSI escape codes
     */
    public function getSequence(): string
    {
        return $this->sequence;
    }

    /**
     *
     * @param string $sequence A string consisting of ANSI escape codes
     * @return void
     */
    public function setSequence(string $sequence): void
    {
        $this->sequence = $sequence;
    }
}
