<?php
declare(strict_types=1);

namespace WernerDweight\Stringy\Exception;

use WernerDweight\EnhancedException\Exception\AbstractEnhancedException;

class StringyException extends AbstractEnhancedException
{
    /** @var int */
    public const EXCEPTION_INVALID_BASE = 1;
    /** @var int */
    public const EXCEPTION_SAME_BASE = 2;
    /** @var int */
    public const EXCEPTION_INVALID_CASE = 3;
    /** @var int */
    public const EXCEPTION_SAME_CASE = 4;

    /** @var string[] */
    protected static $messages = [
        self::EXCEPTION_INVALID_BASE => 'Invalid base %s! Use one of %s.',
        self::EXCEPTION_SAME_BASE => 'Invalid base conversion! Base %s can\'t be converted to itself.',
        self::EXCEPTION_INVALID_CASE => 'Invalid case %s! Use one of %s.',
        self::EXCEPTION_SAME_CASE => 'Invalid case conversion! Case %s can\'t be converted to itself.',
    ];
}
