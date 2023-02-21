<?php
declare(strict_types=1);

namespace WernerDweight\Stringy;

use Safe\Exceptions\PcreException;
use Safe\Exceptions\StringsException;
use WernerDweight\Stringy\Exception\StringyException;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
final class Stringy
{
    /**
     * @var string
     */
    public const BASE_BIN = 'bin';

    /**
     * @var string
     */
    public const BASE_HEX = 'hex';

    /**
     * @var string
     */
    public const CASE_CAMEL = 'camelCase';

    /**
     * @var string
     */
    public const CASE_KEBAB = 'kebab-case';

    /**
     * @var string
     */
    public const CASE_PASCAL = 'PascalCase';

    /**
     * @var string
     */
    public const CASE_SNAKE = 'snake_case';

    /**
     * @var string[]
     */
    private const AVAILABLE_BASES = [
        self::BASE_BIN,
        self::BASE_HEX,
    ];

    /**
     * @var string[]
     */
    private const AVAILABLE_CASES = [
        self::CASE_CAMEL,
        self::CASE_KEBAB,
        self::CASE_PASCAL,
        self::CASE_SNAKE,
    ];

    /**
     * @var string
     */
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function __toString(): string
    {
        return $this->string;
    }

    public function concat(string $string): self
    {
        $this->string .= $string;
        return $this;
    }

    public function sameAs(self $comparison): bool
    {
        return $this->__toString() === $comparison->__toString();
    }

    // standard functions

    /**
     * Quote string with slashes in a C style.
     */
    public function addCSlashes(string $charlist): self
    {
        $this->string = addcslashes($this->string, $charlist);
        return $this;
    }

    /**
     * Quote string with slashes.
     */
    public function addSlashes(): self
    {
        $this->string = addslashes($this->string);
        return $this;
    }

    /**
     * Convert binary data into hexadecimal representation.
     *
     * @throws StringsException
     */
    public function convertFromBinToHex(): self
    {
        return $this->convertBase(self::BASE_BIN, self::BASE_HEX);
    }

    /**
     * Decodes a hexadecimally encoded binary string.
     *
     * @throws StringsException
     */
    public function convertFromHexToBin(): self
    {
        return $this->convertBase(self::BASE_HEX, self::BASE_BIN);
    }

    /**
     * Alias of rtrim.
     */
    public function chop(): self
    {
        return $this->trimRight();
    }

    /**
     * Split a string into smaller chunks.
     * @param int<1, max> $length
     */
    public function chunkSplit(int $length, string $eol = "\r\n"): self
    {
        $this->string = chunk_split($this->string, $length, $eol);
        return $this;
    }

    /**
     * Decode a uuencoded string.
     *
     * @throws StringsException
     */
    public function uudecode(): self
    {
        $this->string = \Safe\convert_uudecode($this->string);
        return $this;
    }

    /**
     * Uuencode a string.
     */
    public function uuencode(): self
    {
        $this->string = convert_uuencode($this->string);
        return $this;
    }

    /**
     * Return information about characters used in a string.
     *
     * @return mixed
     */
    public function getCharacterStats(int $mode = 0)
    {
        return count_chars($this->string, $mode);
    }

    /**
     * Calculates the crc32 polynomial of a string.
     */
    public function crc32(): int
    {
        return crc32($this->string);
    }

    /**
     * One-way string hashing.
     */
    public function crypt(string $salt): self
    {
        $this->string = crypt($this->string, $salt);
        return $this;
    }

    /**
     * Split a string by a string.
     *
     * @param non-empty-string $delimiter
     *
     * @return string[]
     */
    public function explode(string $delimiter, int $limit = PHP_INT_MAX): array
    {
        return explode($delimiter, $this->string, $limit);
    }

    /**
     * Convert logical Hebrew text to visual text.
     */
    public function hebrevToVisual(int $maxCharsPerLine = 0): self
    {
        $this->string = hebrev($this->string, $maxCharsPerLine);
        return $this;
    }

    /**
     * Convert HTML entities to their corresponding characters.
     *
     * @throws \Safe\Exceptions\InfoException
     */
    public function decodeHtmlEntities(int $quoteStyle = ENT_COMPAT | ENT_HTML401, ?string $charset = null): self
    {
        $this->string = html_entity_decode($this->string, $quoteStyle, $charset ?: \Safe\ini_get('default_charset'));
        return $this;
    }

    /**
     * Convert all applicable characters to HTML entities.
     *
     * @throws \Safe\Exceptions\InfoException
     */
    public function encodeHtmlEntities(
        int $quoteStyle = ENT_COMPAT | ENT_HTML401,
        ?string $charset = null,
        bool $doubleEncode = true
    ): self {
        $this->string = htmlentities(
            $this->string,
            $quoteStyle,
            $charset ?: \Safe\ini_get('default_charset'),
            $doubleEncode
        );
        return $this;
    }

    /**
     * Convert special HTML entities back to characters.
     */
    public function decodeHtmlSpecialChars(int $quoteStyle = ENT_COMPAT | ENT_HTML401): self
    {
        $this->string = htmlspecialchars_decode($this->string, $quoteStyle);
        return $this;
    }

    /**
     * Convert special characters to HTML entities.
     */
    public function encodeHtmlSpecialChars(
        int $flags = ENT_COMPAT | ENT_HTML401,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true
    ): self {
        $this->string = htmlspecialchars($this->string, $flags, $encoding, $doubleEncode);
        return $this;
    }

    /**
     * Make a string's first character lowercase.
     */
    public function lowercaseFirst(): self
    {
        $this->string = lcfirst($this->string);
        return $this;
    }

    /**
     * Calculate Levenshtein distance between two strings.
     */
    public function levenshtein(
        string $comparison,
        int $costOfInsertion = 1,
        int $costOfReplacement = 1,
        int $costOfDeletion = 1
    ): int {
        return levenshtein($this->string, $comparison, $costOfInsertion, $costOfReplacement, $costOfDeletion);
    }

    /**
     * Strip whitespace (or other characters) from the beginning of a string.
     */
    public function trimLeft(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = ltrim($this->string, $charlist);
        return $this;
    }

    /**
     * Calculate the md5 hash of a string.
     */
    public function md5(bool $rawOutput = false): self
    {
        $this->string = md5($this->string, $rawOutput);
        return $this;
    }

    /**
     * Calculate the metaphone key of a string.
     */
    public function metaphone(int $phonemes = 0): self
    {
        $this->string = metaphone($this->string, $phonemes);
        return $this;
    }

    /**
     * Inserts HTML line breaks before all newlines in a string.
     */
    public function newlineToBreakElement(bool $isXml = true): self
    {
        $this->string = nl2br($this->string, $isXml);
        return $this;
    }

    /**
     * Parses the string into variables.
     *
     * @return string[]
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function parseIntoVariables(): array
    {
        $variables = [];
        \Safe\mb_parse_str($this->string, $variables);
        return $variables;
    }

    /**
     * Convert a quoted-printable string to an 8 bit string.
     */
    public function decodeQuotedPrintable(): self
    {
        $this->string = quoted_printable_decode($this->string);
        return $this;
    }

    /**
     * Convert a 8 bit string to a quoted-printable string.
     */
    public function encodeQuotedPrintable(): self
    {
        $this->string = quoted_printable_encode($this->string);
        return $this;
    }

    /**
     * Quote meta characters.
     */
    public function quoteMetaCharacters(): self
    {
        $this->string = quotemeta($this->string);
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the end of a string.
     */
    public function trimRight(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = rtrim($this->string, $charlist);
        return $this;
    }

    /**
     * Calculate the sha1 hash of a string.
     */
    public function sha1(bool $rawOutput = false): self
    {
        $this->string = sha1($this->string, $rawOutput);
        return $this;
    }

    /**
     * Calculate the similarity between two strings.
     */
    public function getNumberOfSameCharacters(string $comparison): int
    {
        return similar_text($this->string, $comparison);
    }

    /**
     * Calculate the soundex key of a string.
     */
    public function soundex(): self
    {
        $this->string = soundex($this->string);
        return $this;
    }

    /**
     * Return a formatted string.
     *
     * @param mixed ...$args
     *
     * @throws StringsException
     */
    public function sprintf(...$args): self
    {
        $this->string = \Safe\sprintf($this->string, ...$args);
        return $this;
    }

    /**
     * Parse a CSV string into an array.
     *
     * @return array<int, string|null>
     */
    public function getCsv(string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array
    {
        return str_getcsv($this->string, $delimiter, $enclosure, $escape);
    }

    /**
     * Case-insensitive version of str_replace.
     *
     * @param string|string[] $search
     * @param string|string[] $replace
     */
    public function replaceCaseInsensitive($search, $replace): self
    {
        $this->string = str_ireplace($search, $replace, $this->string);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     */
    public function padLeft(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_LEFT);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     */
    public function padRight(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_RIGHT);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     */
    public function padBoth(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_BOTH);
        return $this;
    }

    /**
     * Repeat a string.
     */
    public function repeat(int $multiplier): self
    {
        $this->string = str_repeat($this->string, $multiplier);
        return $this;
    }

    /**
     * Replace all occurrences of the search string with the replacement string.
     *
     * @param string|string[] $search
     * @param string|string[] $replace
     */
    public function replace($search, $replace): self
    {
        $this->string = str_replace($search, $replace, $this->string);
        return $this;
    }

    /**
     * Perform the rot13 transform on a string.
     */
    public function rot13(): self
    {
        $this->string = str_rot13($this->string);
        return $this;
    }

    /**
     * Randomly shuffles a string.
     */
    public function shuffle(): self
    {
        $this->string = str_shuffle($this->string);
        return $this;
    }

    /**
     * Convert a string to an array.
     *
     * @param int<1, max> $length
     *
     * @return string[]
     */
    public function split(int $length = 1): array
    {
        return str_split($this->string, $length);
    }

    /**
     * Return information about words used in a string.
     */
    public function getWordCount(?string $charlist = null): int
    {
        $args = [$this->string, 0];
        if (null !== $charlist) {
            $args[] = $charlist;
        }
        /** @var int $result */
        $result = str_word_count(...$args);
        return $result;
    }

    /**
     * Binary safe case-insensitive string comparison.
     */
    public function compareCaseInsensitive(string $comparison): int
    {
        return strcasecmp($this->string, $comparison);
    }

    /**
     * Binary safe string comparison.
     */
    public function compare(string $comparison): int
    {
        return strcmp($this->string, $comparison);
    }

    /**
     * Locale based string comparison.
     */
    public function compareBasedOnLocale(string $comparison): int
    {
        return strcoll($this->string, $comparison);
    }

    /**
     * Strip HTML and PHP tags from a string.
     */
    public function stripTags(?string $allowableTags = null): self
    {
        $args = [$this->string];
        if (null !== $allowableTags) {
            $args[] = $allowableTags;
        }
        $this->string = strip_tags(...$args);
        return $this;
    }

    /**
     * Un-quote string quoted with addcslashes.
     */
    public function stripCSlashes(): self
    {
        $this->string = stripcslashes($this->string);
        return $this;
    }

    /**
     * Find the position of the first occurrence of a case-insensitive substring in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getPositionOfSubstringCaseInsensitive(
        string $substring,
        int $offset = 0,
        ?string $encoding = null
    ): ?int {
        return mb_stripos(
            $this->string,
            $substring,
            $offset,
            $encoding ?: (string)\Safe\mb_internal_encoding()
        ) ?: null;
    }

    /**
     * Un-quotes a quoted string.
     */
    public function stripSlashes(): self
    {
        $this->string = stripslashes($this->string);
        return $this;
    }

    /**
     * Case-insensitive strstr.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getMatchedSubstringCaseInsensitive(
        string $substring,
        bool $beforeNeedle = false,
        ?string $encoding = null
    ): ?string {
        return mb_stristr(
            $this->string,
            $substring,
            $beforeNeedle,
            $encoding ?: (string)\Safe\mb_internal_encoding()
        ) ?: null;
    }

    /**
     * Get string length.
     */
    public function length(?string $encoding = null): int
    {
        return mb_strlen($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
    }

    /**
     * Case-insensitive string comparisons using a "natural order" algorithm.
     */
    public function compareUsingNaturalOrderCaseInsensitive(string $comparison): int
    {
        return strnatcasecmp($this->string, $comparison);
    }

    /**
     * String comparisons using a "natural order" algorithm.
     */
    public function compareUsingNaturalOrder(string $comparison): int
    {
        return strnatcmp($this->string, $comparison);
    }

    /**
     * Binary safe case-insensitive string comparison of the first n characters.
     */
    public function compareFirstNCharactersCaseInsensitive(string $comparison, int $length): int
    {
        return strncasecmp($this->string, $comparison, $length);
    }

    /**
     * Binary safe string comparison of the first n characters.
     */
    public function compareFirstNCharacters(string $comparison, int $length): int
    {
        return strncmp($this->string, $comparison, $length);
    }

    /**
     * Search a string for any of a set of characters.
     */
    public function searchForAnyOf(string $charlist): ?string
    {
        return strpbrk($this->string, $charlist) ?: null;
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getPositionOfSubstring(string $substring, int $offset = 0, ?string $encoding = null): ?int
    {
        $position = mb_strpos($this->string, $substring, $offset, $encoding ?: (string)\Safe\mb_internal_encoding());
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Find the last occurrence of a character in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getLastOccuranceOfCharacter(
        string $character,
        bool $part = false,
        ?string $encoding = null
    ): ?string {
        return mb_strrchr($this->string, $character, $part, $encoding ?: (string)\Safe\mb_internal_encoding()) ?: null;
    }

    /**
     * Find the last occurrence of a character in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getLastOccuranceOfCharacterCaseInsensitive(
        string $character,
        bool $part = false,
        ?string $encoding = null
    ): ?string {
        return mb_strrichr($this->string, $character, $part, $encoding ?: (string)\Safe\mb_internal_encoding()) ?: null;
    }

    /**
     * Reverse a string.
     */
    public function reverse(): self
    {
        $this->string = strrev($this->string);
        return $this;
    }

    /**
     * Find the position of the last occurrence of a case-insensitive substring in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getPositionOfLastSubstringCaseInsensitive(
        string $substring,
        int $offset = 0,
        ?string $encoding = null
    ): ?int {
        $position = mb_strripos($this->string, $substring, $offset, $encoding ?: (string)\Safe\mb_internal_encoding());
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Find the position of the last occurrence of a substring in a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getPositionOfLastSubstring(string $substring, int $offset = 0, ?string $encoding = null): ?int
    {
        $position = mb_strrpos($this->string, $substring, $offset, $encoding ?: (string)\Safe\mb_internal_encoding());
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Find the first occurrence of a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getMatchedSubstring(
        string $substring,
        bool $beforeNeedle = false,
        ?string $encoding = null
    ): ?string {
        return mb_strstr(
            $this->string,
            $substring,
            $beforeNeedle,
            $encoding ?: (string)\Safe\mb_internal_encoding()
        ) ?: null;
    }

    /**
     * Tokenize string.
     */
    public function tokenize(string $delimiter): self
    {
        $result = strtok($this->string, $delimiter);
        if (false === $result) {
            throw new StringyException(StringyException::EXCEPTION_UNEXPECTED_RESULT);
        }
        $this->string = $result;
        return $this;
    }

    /**
     * Make a string lowercase.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function toLowercase(?string $encoding = null): self
    {
        $this->string = mb_strtolower($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
        return $this;
    }

    /**
     * Make a string uppercase.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function toUppercase(?string $encoding = null): self
    {
        $this->string = mb_strtoupper($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
        return $this;
    }

    /**
     * Translate characters or replace substrings.
     */
    public function translate(string $from, string $to): self
    {
        $this->string = strtr($this->string, $from, $to);
        return $this;
    }

    /**
     * Binary safe comparison of two strings from an offset, up to length characters.
     */
    public function compareWithOffsetAndLimit(
        string $comparison,
        int $offset,
        ?int $limit = null,
        bool $caseInsensitive = false
    ): int {
        if (null === $limit) {
            $limit = max(mb_strlen($comparison), mb_strlen($this->string) - $offset);
        }
        return substr_compare($this->string, $comparison, $offset, $limit, $caseInsensitive);
    }

    /**
     * Count the number of substring occurrences.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getNumberOfSubstringOccurances(string $substring, ?string $encoding = null): int
    {
        return mb_substr_count($this->string, $substring, $encoding ?: (string)\Safe\mb_internal_encoding());
    }

    /**
     * Replace text within a portion of a string.
     */
    public function replaceSubstring(string $replacement, int $offset, ?int $limit = null): self
    {
        $this->string = substr_replace($this->string, $replacement, $offset, $limit);
        return $this;
    }

    /**
     * Return part of a string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function substring(int $offset, ?int $limit = null, ?string $encoding = null): self
    {
        $this->string = mb_substr($this->string, $offset, $limit, $encoding ?: (string)\Safe\mb_internal_encoding());
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of a string.
     */
    public function trimBoth(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = trim($this->string, $charlist);
        return $this;
    }

    /**
     * Make a string's first character uppercase.
     */
    public function uppercaseFirst(): self
    {
        $this->string = ucfirst($this->string);
        return $this;
    }

    /**
     * Uppercase the first character of each word in a string.
     */
    public function uppercaseWords(string $delimiters = " \t\r\n\f\v"): self
    {
        $this->string = ucwords($this->string, $delimiters);
        return $this;
    }

    /**
     * Wraps a string to a given number of characters.
     */
    public function wordWrap(int $width, string $break = "\n", bool $cut = false): self
    {
        $this->string = wordwrap($this->string, $width, $break, $cut);
        return $this;
    }

    // mb functions

    /**
     * Check if the string is valid for the specified encoding.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function checkEncoding(?string $encoding = null): bool
    {
        return mb_check_encoding($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
    }

    /**
     * Convert character encoding.
     */
    public function convertEncoding(string $to, ?string $from = null): self
    {
        /** @var string $encoded */
        $encoded = \Safe\mb_convert_encoding($this->string, $to, $from);
        $this->string = $encoded;
        return $this;
    }

    /**
     * Detect character encoding.
     *
     * @param string[]|null $encodingList
     */
    public function detectEncoding(?array $encodingList = null): ?string
    {
        return mb_detect_encoding($this->string, $encodingList, true) ?: null;
    }

    /**
     * Regular expression match for multibyte string.
     */
    public function eregMatch(string $pattern, string $option = 'msr'): bool
    {
        return mb_ereg_match($this->string, $pattern, $option);
    }

    /**
     * Perform a regular expression search and replace with multibyte support using a callback.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function eregReplaceCallback(string $pattern, callable $callback, string $option = 'msr'): self
    {
        $args = [$pattern, $callback, $this->string, $option];
        $this->string = (string)\Safe\mb_ereg_replace_callback(...$args);
        return $this;
    }

    /**
     * Replace regular expression with multibyte support.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function eregReplace(string $pattern, string $replacement, string $option = 'msr'): self
    {
        $this->string = (string)\Safe\mb_ereg_replace($pattern, $replacement, $this->string, $option);
        return $this;
    }

    /**
     * Regular expression match with multibyte support.
     *
     * @param string[]|null $regs
     */
    public function ereg(string $pattern, ?array $regs = null): bool
    {
        $match = mb_ereg($pattern, $this->string, $regs);
        if (false === $match) {
            throw new StringyException(StringyException::EXCEPTION_UNEXPECTED_RESULT);
        }
        return true;
    }

    /**
     * Replace regular expression with multibyte support ignoring case.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function eregReplaceCaseInsensitive(string $pattern, string $replace, string $option = 'msr'): self
    {
        $this->string = \Safe\mb_eregi_replace($pattern, $replace, $this->string, $option);
        return $this;
    }

    /**
     * Regular expression match ignoring case with multibyte support.
     *
     * @param string[]|null $regs
     */
    public function eregCaseInsensitive(string $pattern, ?array $regs = null): bool
    {
        return mb_eregi($pattern, $this->string, $regs);
    }

    /**
     * Replaces ill-formed multi-byte characters with question marks.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function scrub(?string $encoding = null): self
    {
        $this->string = mb_scrub($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
        return $this;
    }

    /**
     * Split multibyte string using regular expression.
     *
     * @return string[]
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function splitByRegularExpression(string $pattern, int $limit = -1): array
    {
        return \Safe\mb_split($pattern, $this->string, $limit);
    }

    /**
     * Get truncated string with specified width.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function trimToLengthWithTrimmer(
        int $start,
        int $length,
        string $trimmer = '...',
        ?string $encoding = null
    ): self {
        $this->string = mb_strimwidth(
            $this->string,
            $start,
            $length,
            $trimmer,
            $encoding ?: (string)\Safe\mb_internal_encoding()
        );
        return $this;
    }

    /**
     * Return width of string.
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function monotypeWidth(?string $encoding = null): int
    {
        return mb_strwidth($this->string, $encoding ?: (string)\Safe\mb_internal_encoding());
    }

    // regular expressions

    /**
     * Perform a regular expression search and replace.
     */
    public function pregFilter(string $pattern, string $replacement, int $limit = -1): self
    {
        $this->string = (string)preg_filter($pattern, $replacement, $this->string, $limit);
        return $this;
    }

    /**
     * Perform a global regular expression match.
     *
     * @return string[]
     *
     * @throws PcreException
     */
    public function pregGetAllMatches(string $pattern, int $flags = PREG_PATTERN_ORDER, int $offset = 0): array
    {
        $matches = [];
        \Safe\preg_match_all($pattern, $this->string, $matches, $flags, $offset);
        return $matches;
    }

    /**
     * Perform a regular expression match.
     *
     * @throws PcreException
     */
    public function pregMatch(string $pattern, int $flags = 0, int $offset = 0): bool
    {
        $matches = [];
        return \Safe\preg_match($pattern, $this->string, $matches, $flags, $offset) > 0;
    }

    /**
     * Quote regular expression characters.
     */
    public function pregQuote(?string $delimiter = null): self
    {
        $args = [$this->string];
        if (null !== $delimiter) {
            $args[] = $delimiter;
        }
        $this->string = preg_quote(...$args);
        return $this;
    }

    /**
     * Perform a regular expression search and replace using callbacks.
     *
     * @param array<string, callable():mixed> $patternsAndCallbacks
     */
    public function pregReplaceCallbackArray(array $patternsAndCallbacks, int $limit = -1): self
    {
        $replacedString = preg_replace_callback_array($patternsAndCallbacks, $this->string, $limit);
        if (null === $replacedString) {
            throw new StringyException(StringyException::EXCEPTION_UNEXPECTED_RESULT);
        }
        $this->string = $replacedString;
        return $this;
    }

    /**
     * Perform a regular expression search and replace using a callback.
     */
    public function pregReplaceCallback(string $pattern, callable $callback, int $limit = -1): self
    {
        /** @var string $replacedString */
        $replacedString = preg_replace_callback($pattern, $callback, $this->string, $limit);
        $this->string = $replacedString;
        return $this;
    }

    /**
     * Perform a regular expression search and replace.
     *
     * @throws PcreException
     */
    public function pregReplace(string $pattern, string $replacement, int $limit = -1): self
    {
        /** @var string $replacedString */
        $replacedString = \Safe\preg_replace($pattern, $replacement, $this->string, $limit);
        $this->string = $replacedString;
        return $this;
    }

    /**
     * Split string by a regular expression.
     *
     * @return string[]
     *
     * @throws PcreException
     */
    public function pregSplit(string $pattern, int $limit = -1): array
    {
        return \Safe\preg_split($pattern, $this->string, $limit);
    }

    // extra functions

    /**
     * @return int[]
     *
     * @throws \Safe\Exceptions\MbstringException
     */
    public function getPositionsOfSubstring(string $substring): array
    {
        $substringy = new self($substring);

        $position = 0;
        $positions = [];
        $position = $this->getPositionOfSubstring((string)$substringy, $position);
        while (null !== $position) {
            $positions[] = $position;
            $position += $substringy->length();
            $position = $this->getPositionOfSubstring((string)$substringy, $position);
        }
        return $positions;
    }

    /**
     * @throws StringsException
     */
    public function convertBase(string $from, string $to): self
    {
        if (true !== in_array($from, self::AVAILABLE_BASES, true)) {
            throw new StringyException(StringyException::EXCEPTION_INVALID_BASE, [$from, self::AVAILABLE_BASES]);
        }
        if (true !== in_array($to, self::AVAILABLE_BASES, true)) {
            throw new StringyException(StringyException::EXCEPTION_INVALID_BASE, [$to, self::AVAILABLE_BASES]);
        }
        if ($from === $to) {
            throw new StringyException(StringyException::EXCEPTION_SAME_BASE, [$from]);
        }

        /** @var callable(string):string $conversionFunction */
        $conversionFunction = \Safe\sprintf('%s2%s', $from, $to);
        $this->string = $conversionFunction($this->string);

        return $this;
    }

    /**
     * @throws PcreException
     * @throws \Safe\Exceptions\MbstringException
     */
    public function convertCase(string $from, string $to): self
    {
        $this->runConvertCaseChecks($from, $to);

        if (self::CASE_KEBAB !== $from) {
            $this->toKebab($from);
        }

        if (self::CASE_KEBAB === $to) {
            return $this;
        }

        if (self::CASE_SNAKE === $to) {
            return $this->replace('-', '_');
        }

        $positions = $this->getPositionsOfSubstring('-');
        if (count($positions) > 0) {
            foreach ($positions as $position) {
                $this->string[$position + 1] = mb_strtoupper($this->string[$position + 1]);
            }
        }

        if (self::CASE_PASCAL === $to) {
            $this->uppercaseFirst();
        }

        return $this->replace('-', '');
    }

    /**
     * @throws \Safe\Exceptions\MbstringException
     */
    public function dotNotationToCamelCase(string $value): string
    {
        $positions = $this->getPositionsOfSubstring($value);
        if (count($positions) > 0) {
            foreach ($positions as $position) {
                $value[$position + 1] = strtoupper($value[$position + 1]);
            }
        }
        /** @var string $string */
        $string = str_replace('.', '', $value);

        return $string;
    }

    /**
     * @throws PcreException
     */
    private function toKebab(string $from): self
    {
        if (self::CASE_SNAKE === $from) {
            return $this->replace('_', '-');
        }

        if (self::CASE_PASCAL === $from) {
            $this->lowercaseFirst();
        }

        return $this->pregReplace('/([A-Z])/', '-$1')
            ->toLowercase();
    }

    private function runConvertCaseChecks(string $from, string $to): void
    {
        if (true !== in_array($from, self::AVAILABLE_CASES, true)) {
            throw new StringyException(StringyException::EXCEPTION_INVALID_CASE, [$from, self::AVAILABLE_CASES]);
        }
        if (true !== in_array($to, self::AVAILABLE_CASES, true)) {
            throw new StringyException(StringyException::EXCEPTION_INVALID_CASE, [$to, self::AVAILABLE_CASES]);
        }
        if ($from === $to) {
            throw new StringyException(StringyException::EXCEPTION_SAME_CASE, [$from]);
        }
    }
}
