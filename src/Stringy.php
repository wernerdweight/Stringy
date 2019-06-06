<?php
declare(strict_types=1);

namespace WernerDweight\Stringy;

use Safe\Exceptions\StringsException;
use WernerDweight\Stringy\Exception\StringyException;

class Stringy
{
    /** @var string */
    public const BASE_BIN = 'bin';
    /** @var string */
    public const BASE_HEX = 'hex';

    /** @var string[] */
    private const AVAILABLE_BASES = [
        self::BASE_BIN,
        self::BASE_HEX,
    ];

    /** @var string */
    public const CASE_CAMEL = 'camelCase';
    /** @var string */
    public const CASE_KEBAB = 'kebab-case';
    /** @var string */
    public const CASE_PASCAL = 'PascalCase';
    /** @var string */
    public const CASE_SNAKE = 'snake_case';

    /** @var string[] */
    private const AVAILABLE_CASES = [
        self::CASE_CAMEL,
        self::CASE_KEBAB,
        self::CASE_PASCAL,
        self::CASE_SNAKE,
    ];

    /** @var string */
    private $string;

    /**
     * Stringy constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }

    // standard functions

    /**
     * Quote string with slashes in a C style.
     *
     * @param string $charlist
     * @return Stringy
     */
    public function addCSlashes(string $charlist): self
    {
        $this->string = addcslashes($this->string, $charlist);
        return $this;
    }

    /**
     * Quote string with slashes.
     *
     * @return Stringy
     */
    public function addSlashes(): self
    {
        $this->string = addslashes($this->string);
        return $this;
    }

    /**
     * Convert binary data into hexadecimal representation.
     *
     * @return Stringy
     * @throws StringsException
     */
    public function convertFromBinToHex(): self
    {
        return $this->convertBase(self::BASE_BIN, self::BASE_HEX);
    }

    /**
     * Decodes a hexadecimally encoded binary string.
     *
     * @return Stringy
     * @throws StringsException
     */
    public function convertFromHexToBin(): self
    {
        return $this->convertBase(self::BASE_HEX, self::BASE_BIN);
    }

    /**
     * Alias of rtrim.
     *
     * @return Stringy
     */
    public function chop(): self
    {
        return $this->trimRight();
    }

    /**
     * Split a string into smaller chunks.
     *
     * @param int|null $length
     * @param string|null $eol
     * @return Stringy
     */
    public function chunkSplit(?int $length = null, ?string $eol = null): self
    {
        $this->string = chunk_split($this->string, $length, $eol);
        return $this;
    }

    /**
     * Convert from one Cyrillic character set to another.
     *
     * @param string $from
     * @param string $to
     * @return Stringy
     */
    public function convertCyrillicString(string $from, string $to): self
    {
        $this->string = convert_cyr_string($this->string, $from, $to);
        return $this;
    }

    /**
     * Decode a uuencoded string.
     *
     * @return Stringy
     */
    public function uudecode(): self
    {
        $this->string = convert_uudecode($this->string);
        return $this;
    }

    /**
     * Uuencode a string.
     *
     * @return Stringy
     */
    public function uuencode(): self
    {
        $this->string = convert_uuencode($this->string);
        return $this;
    }

    /**
     * Return information about characters used in a string.
     *
     * @param int|null $mode
     * @return mixed
     */
    public function getCharacterStats(?int $mode = null)
    {
        return count_chars($this->string, $mode);
    }

    /**
     * Calculates the crc32 polynomial of a string.
     *
     * @return int
     */
    public function crc32(): int
    {
        return crc32($this->string);
    }

    /**
     * One-way string hashing.
     *
     * @param string|null $salt
     * @return Stringy
     */
    public function crypt(?string $salt = null): self
    {
        $this->string = crypt($this->string, $salt);
        return $this;
    }

    /**
     * Split a string by a string.
     *
     * @param string $delimiter
     * @param int|null $limit
     * @return string[]
     */
    public function explode(string $delimiter, ?int $limit = null): array
    {
        return explode($delimiter, $this->string, $limit);
    }

    /**
     * TODO:
     * Write a formatted string to a stream.
     *
     * @return int
     */
    public function fprintf()
    {
        return fprintf($this->string);
        return $this;
    }

    /**
     * Convert logical Hebrew text to visual text.
     *
     * @param int|null $maxCharsPerLine
     * @return Stringy
     */
    public function hebrevToVisual(?int $maxCharsPerLine = null): self
    {
        $this->string = hebrev($this->string, $maxCharsPerLine);
        return $this;
    }

    /**
     * Convert logical Hebrew text to visual text with newline conversion.
     *
     * @param int|null $maxCharsPerLine
     * @return Stringy
     */
    public function hebrevToVisualWithNewlineConversion(?int $maxCharsPerLine = null): self
    {
        $this->string = hebrevc($this->string, $maxCharsPerLine);
        return $this;
    }

    /**
     * Convert HTML entities to their corresponding characters.
     *
     * @param int|null $quoteStyle
     * @param string|null $charset
     * @return Stringy
     */
    public function decodeHtmlEntities(?int $quoteStyle = null, ?string $charset = null): self
    {
        $this->string = html_entity_decode($this->string, $quoteStyle, $charset);
        return $this;
    }

    /**
     * Convert all applicable characters to HTML entities.
     *
     * @param int|null $quoteStyle
     * @param string|null $charset
     * @param bool $doubleEncode
     * @return Stringy
     */
    public function encodeHtmlEntities(
        ?int $quoteStyle = null,
        ?string $charset = null,
        bool $doubleEncode = true
    ): self {
        $this->string = htmlentities($this->string, $quoteStyle, $charset, $doubleEncode);
        return $this;
    }

    /**
     * Convert special HTML entities back to characters.
     *
     * @param int|null $quoteStyle
     * @return Stringy
     */
    public function decodeHtmlSpecialChars(?int $quoteStyle = null): self
    {
        $this->string = htmlspecialchars_decode($this->string, $quoteStyle);
        return $this;
    }

    /**
     * Convert special characters to HTML entities.
     *
     * @param int|null $flags
     * @param string $encoding
     * @param bool $doubleEncode
     * @return Stringy
     */
    public function encodeHtmlSpecialChars(
        ?int $flags = ENT_COMPAT | ENT_HTML401,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true
    ): self {
        $this->string = htmlspecialchars($this->string, $flags, $encoding, $doubleEncode);
        return $this;
    }

    /**
     * Make a string's first character lowercase.
     *
     * @return Stringy
     */
    public function lowercaseFirst(): self
    {
        $this->string = lcfirst($this->string);
        return $this;
    }

    /**
     * Calculate Levenshtein distance between two strings.
     *
     * @param string $comparison
     * @param int|null $costOfInsertion
     * @param int|null $costOfReplacement
     * @param int|null $costOfDeletion
     * @return int
     */
    public function levenshtein(
        string $comparison,
        ?int $costOfInsertion = null,
        ?int $costOfReplacement = null,
        ?int $costOfDeletion = null
    ): int {
        return levenshtein($this->string, $comparison, $costOfInsertion, $costOfReplacement, $costOfDeletion);
    }

    /**
     * Strip whitespace (or other characters) from the beginning of a string.
     *
     * @param string $charlist
     * @return Stringy
     */
    public function trimLeft(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = ltrim($this->string, $charlist);
        return $this;
    }

    /**
     * Calculate the md5 hash of a string.
     *
     * @param bool|null $rawOutput
     * @return Stringy
     */
    public function md5(?bool $rawOutput = null): self
    {
        $this->string = md5($this->string, $rawOutput);
        return $this;
    }

    /**
     * Calculate the metaphone key of a string.
     *
     * @param int $phonemes
     * @return Stringy
     */
    public function metaphone(int $phonemes = 0): self
    {
        $this->string = metaphone($this->string, $phonemes);
        return $this;
    }

    /**
     * Formats a number as a currency string.
     *
     * @param string $format
     * @return Stringy
     */
    public function moneyFormat(string $format): self
    {
        $this->string = money_format($format, $this->string);
        return $this;
    }

    /**
     * Inserts HTML line breaks before all newlines in a string.
     *
     * @param bool $isXml
     * @return Stringy
     */
    public function newlineToBreakElement(bool $isXml = true): self
    {
        $this->string = nl2br($this->string, $isXml);
        return $this;
    }

    /**
     * Format a number with grouped thousands.
     *
     * @param int $decimals
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     * @return Stringy
     */
    public function numberFormat(int $decimals = 0, string $decimalPoint = '.', string $thousandsSeparator = ','): self
    {
        $this->string = number_format($this->string, $decimals, $decimalPoint, $thousandsSeparator);
        return $this;
    }

    /**
     * Convert the first byte of a string to a value between 0 and 255.
     *
     * @return int
     */
    public function ord()
    {
        // TODO:
        return ord($this->string);
        return $this;
    }

    /**
     * Parses the string into variables.
     */
    public function parseIntoVariables(): array
    {
        $variables = [];
        parse_str($this->string, $variables);
        return $variables;
    }

    /**
     * Output a formatted string.
     *
     * @param mixed ...$args
     * @return Stringy
     */
    public function printf(...$args): self
    {
        $this->string = printf($this->string, ...$args);
        return $this;
    }

    /**
     * Convert a quoted-printable string to an 8 bit string.
     *
     * @return Stringy
     */
    public function decodeQuotedPrintable(): self
    {
        $this->string = quoted_printable_decode($this->string);
        return $this;
    }

    /**
     * Convert a 8 bit string to a quoted-printable string.
     *
     * @return Stringy
     */
    public function encodeQuotedPrintable(): self
    {
        $this->string = quoted_printable_encode($this->string);
        return $this;
    }

    /**
     * Quote meta characters.
     *
     * @return Stringy
     */
    public function quoteMetaCharacters(): self
    {
        $this->string = quotemeta($this->string);
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the end of a string.
     *
     * @param string $charlist
     * @return Stringy
     */
    public function trimRight(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = rtrim($this->string, $charlist);
        return $this;
    }

    /**
     * Calculate the sha1 hash of a string.
     *
     * @param bool|null $rawOutput
     * @return Stringy
     */
    public function sha1(?bool $rawOutput = null): self
    {
        return sha1($this->string, $rawOutput);
        return $this;
    }

    /**
     * Calculate the similarity between two strings.
     *
     * @param string $comparison
     * @return int
     */
    public function getNumberOfSameCharacters(string $comparison): int
    {
        return similar_text($this->string, $comparison);
    }

    /**
     * Calculate the soundex key of a string.
     *
     * @return Stringy
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
     * @return Stringy
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
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @return array
     */
    public function getCsv(string $delimiter = ',', string $enclosure = '"', string $escape = "\\"): array
    {
        return str_getcsv($this->string, $delimiter, $enclosure, $escape);
    }

    /**
     * Case-insensitive version of str_replace.
     *
     * @param string|string[] $search
     * @param string|string[] $replace
     * @return Stringy
     */
    public function replaceCaseInsensitive($search, $replace): self
    {
        $this->string = str_ireplace($search, $replace, $this->string);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     *
     * @param int $length
     * @param string $padString
     * @return Stringy
     */
    public function padLeft(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_LEFT);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     *
     * @param int $length
     * @param string $padString
     * @return Stringy
     */
    public function padRight(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_RIGHT);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     *
     * @param int $length
     * @param string $padString
     * @return Stringy
     */
    public function padBoth(int $length, string $padString = ' '): self
    {
        $this->string = str_pad($this->string, $length, $padString, STR_PAD_BOTH);
        return $this;
    }

    /**
     * Repeat a string.
     *
     * @param int $multiplier
     * @return Stringy
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
     * @return Stringy
     */
    public function replace($search, $replace): self
    {
        $this->string = str_replace($search, $replace, $this->string);
        return $this;
    }

    /**
     * Perform the rot13 transform on a string.
     *
     * @return Stringy
     */
    public function rot13(): self
    {
        $this->string = str_rot13($this->string);
        return $this;
    }

    /**
     * Randomly shuffles a string.
     *
     * @return Stringy
     */
    public function shuffle(): self
    {
        $this->string = str_shuffle($this->string);
        return $this;
    }

    /**
     * Convert a string to an array.
     *
     * @return string[]
     */
    public function split(int $length = 1): array
    {
        return str_split($this->string, $length);
    }

    /**
     * Return information about words used in a string.
     *
     * @param string|null $charlist
     * @return int
     */
    public function getWordCount(?string $charlist = null): int
    {
        return str_word_count($this->string, null, $charlist);
    }

    /**
     * Binary safe case-insensitive string comparison.
     *
     * @param string $comparison
     * @return int
     */
    public function compareCaseInsensitive(string $comparison): int
    {
        return strcasecmp($this->string, $comparison);
    }

    /**
     * Binary safe string comparison.
     *
     * @param string $comparison
     * @return int
     */
    public function compare(string $comparison): int
    {
        return strcmp($this->string, $comparison);
    }

    /**
     * Locale based string comparison.
     *
     * @param string $comparison
     * @return int
     */
    public function compareBasedOnLocale(string $comparison): int
    {
        return strcoll($this->string, $comparison);
    }

    /**
     * Find length of initial segment not matching mask.
     *
     * @return int
     */
    public function strcspn()
    {
        // TODO:
        return strcspn($this->string);
        return $this;
    }

    /**
     * Strip HTML and PHP tags from a string.
     *
     * @param string|null $allowableTags
     * @return Stringy
     */
    public function stripTags(?string $allowableTags = null): self
    {
        $this->string = strip_tags($this->string, $allowableTags);
        return $this;
    }

    /**
     * Un-quote string quoted with addcslashes.
     *
     * @return Stringy
     */
    public function stripCSlashes(): self
    {
        $this->string = stripcslashes($this->string);
        return $this;
    }

    /**
     * Find the position of the first occurrence of a case-insensitive substring in a string.
     *
     * @param string $substring
     * @param int|null $offset
     * @return int
     */
    public function getPositionOfSubstringCaseInsensitive(string $substring, ?int $offset = null): int
    {
        return stripos($this->string, $substring, $offset);
    }

    /**
     * Un-quotes a quoted string.
     *
     * @return Stringy
     */
    public function stripSlashes(): self
    {
        $this->string = stripslashes($this->string);
        return $this;
    }

    /**
     * Case-insensitive strstr.
     *
     * @param string $substring
     * @param bool|null $beforeNeedle
     * @return Stringy
     */
    public function getMatchedSubstringCaseInsensitive(string $substring, ?bool $beforeNeedle = null): self
    {
        $this->string = stristr($this->string, $substring, $beforeNeedle);
        return $this;
    }

    /**
     * Get string length.
     *
     * @return int
     */
    public function length(): int
    {
        return strlen($this->string);
    }

    /**
     * Case insensitive string comparisons using a "natural order" algorithm.
     *
     * @param string $comparison
     * @return int
     */
    public function compareUsingNaturalOrderCaseInsensitive(string $comparison): int
    {
        return strnatcasecmp($this->string, $comparison);
    }

    /**
     * String comparisons using a "natural order" algorithm.
     *
     * @param string $comparison
     * @return int
     */
    public function compareUsingNaturalOrder(string $comparison): int
    {
        return strnatcmp($this->string, $comparison);
    }

    /**
     * Binary safe case-insensitive string comparison of the first n characters.
     *
     * @param string $comparison
     * @param int $length
     * @return int
     */
    public function compareFirstNCharactersCaseInsensitive(string $comparison, int $length): int
    {
        return strncasecmp($this->string, $comparison, $length);
    }

    /**
     * Binary safe string comparison of the first n characters.
     *
     * @param string $comparison
     * @param int $length
     * @return int
     */
    public function compareFirstNCharacters(string $comparison, int $length): int
    {
        return strncmp($this->string, $comparison, $length);
    }

    /**
     * Search a string for any of a set of characters.
     *
     * @param string $charlist
     * @return Stringy
     */
    public function searchForAnyOf(string $charlist): self
    {
        $this->string = strpbrk($this->string, $charlist);
        return $this;
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     *
     * @param string $substring
     * @param int $offset
     * @return int|null
     */
    public function getPositionOfSubstring(string $substring, int $offset = 0): ?int
    {
        $position = strpos($this->string, $substring, $offset);
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Find the last occurrence of a character in a string.
     *
     * @param string $character
     * @return Stringy
     */
    public function getLastOccuranceOfCharacter(string $character): self
    {
        $this->string = strrchr($this->string, $character);
        return $this;
    }

    /**
     * Reverse a string.
     *
     * @return Stringy
     */
    public function reverse(): self
    {
        $this->string = strrev($this->string);
        return $this;
    }

    /**
     * Find the position of the last occurrence of a case-insensitive substring in a string.
     *
     * @param string $substring
     * @param int $offset
     * @return int|null
     */
    public function getPositionOfLastSubstringCaseInsensitive(string $substring, int $offset = 0): ?int
    {
        $position = strripos($this->string, $substring, $offset);
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Find the position of the last occurrence of a substring in a string.
     *
     * @param string $substring
     * @param int $offset
     * @return bool|int
     */
    public function getPositionOfLastSubstring(string $substring, int $offset = 0): ?int
    {
        $position = strrpos($this->string, $substring, $offset);
        if (false === $position) {
            return null;
        }
        return $position;
    }

    /**
     * Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask.
     *
     * @return int
     */
    public function strspn()
    {
        // TODO:
        return strspn($this->string);
        return $this;
    }

    /**
     * Find the first occurrence of a string.
     *
     * @param string $substring
     * @param bool|null $beforeNeedle
     * @return Stringy
     */
    public function getMatchedSubstring(string $substring, ?bool $beforeNeedle = null): self
    {
        $this->string = strstr($this->string, $substring, $beforeNeedle);
        return $this;
    }

    /**
     * Tokenize string.
     *
     * @param string $delimiter
     * @return Stringy
     */
    public function tokenize(string $delimiter): self
    {
        $this->string = strtok($this->string, $delimiter);
        return $this;
    }

    /**
     * Make a string lowercase.
     *
     * @return Stringy
     */
    public function toLowercase(): self
    {
        $this->string = strtolower($this->string);
        return $this;
    }

    /**
     * Make a string uppercase.
     *
     * @return Stringy
     */
    public function toUppercase(): self
    {
        $this->string = strtoupper($this->string);
        return $this;
    }

    /**
     * Translate characters or replace substrings.
     *
     * @param string $from
     * @param string $to
     * @return Stringy
     */
    public function translate(string $from, string $to): self
    {
        $this->string = strtr($this->string, $from, $to);
        return $this;
    }

    /**
     * Binary safe comparison of two strings from an offset, up to length characters.
     *
     * @param string $comparison
     * @param int $offset
     * @param int|null $limit
     * @param bool|null $caseInsensitive
     * @return int
     */
    public function compareWithOffsetAndLimit(
        string $comparison,
        int $offset,
        ?int $limit = null,
        ?bool $caseInsensitive = null
    ): int {
        return substr_compare($this->string, $comparison, $offset, $limit, $caseInsensitive);
    }

    /**
     * Count the number of substring occurrences.
     *
     * @param string $substring
     * @param int|null $offset
     * @param int|null $limit
     * @return int
     */
    public function getNumberOfSubstringOccurances(string $substring, ?int $offset = null, ?int $limit = null): int
    {
        return substr_count($this->string, $substring, $offset, $limit);
    }

    /**
     * Replace text within a portion of a string.
     *
     * @param string $replacement
     * @param int $offset
     * @param int|null $limit
     * @return mixed
     */
    public function replaceSubstring(string $replacement, int $offset, ?int $limit = null): self
    {
        $this->string = substr_replace($this->string, $replacement, $offset, $limit);
        return $this;
    }

    /**
     * Return part of a string.
     *
     * @param int $offset
     * @param int|null $limit
     * @return Stringy
     */
    public function substring(int $offset, ?int $limit = null): self
    {
        $this->string = substr($this->string, $offset, $limit);
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of a string.
     *
     * @param string $charlist
     * @return Stringy
     */
    public function trimBoth(string $charlist = " \t\n\r\0\x0B"): self
    {
        $this->string = trim($this->string, $charlist);
        return $this;
    }

    /**
     * Make a string's first character uppercase.
     *
     * @return Stringy
     */
    public function uppercaseFirst(): self
    {
        $this->string = ucfirst($this->string);
        return $this;
    }

    /**
     * Uppercase the first character of each word in a string.
     *
     * @param string $delimiters
     * @return Stringy
     */
    public function uppercaseWords(string $delimiters = " \t\r\n\f\v"): self
    {
        $this->string = ucwords($this->string, $delimiters);
        return $this;
    }

    /**
     * Wraps a string to a given number of characters.
     *
     * @param int $width
     * @param string $break
     * @param bool $cut
     * @return Stringy
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
     * @param string|null $encoding
     * @return bool
     */
    public function checkEncoding(?string $encoding = null): bool
    {
        return mb_check_encoding($this->string, $encoding);
    }

    /**
     * Convert character encoding.
     *
     * @param string $to
     * @param string|null $from
     * @return Stringy
     */
    public function convertEncoding(string $to, ?string $from = null): self
    {
        $this->string = mb_convert_encoding($this->string, $to, $from);
        return $this;
    }

    /**
     * Detect character encoding.
     *
     * @param array|null $encodingList
     * @return string|null
     */
    public function detectEncoding(array $encodingList = null): ?string
    {
        return mb_detect_encoding($this->string, $encodingList, true) ?: null;
    }

    /**
     * Regular expression match for multibyte string.
     *
     * @param string $pattern
     * @param string|null $option
     * @return bool
     */
    public function eregMatch(string $pattern, ?string $option = null): bool
    {
        return mb_ereg_match($this->string, $pattern, $option);
    }

    /**
     * Perform a regular expression search and replace with multibyte support using a callback.
     *
     * @param string $pattern
     * @param callable $callback
     * @param string $option
     * @return Stringy
     */
    public function eregReplaceCallback(string $pattern, callable $callback, string $option = 'msr'): self
    {
        $this->string = mb_ereg_replace_callback($pattern, $callback, $this->string, $option);
        return $this;
    }

    /**
     * Replace regular expression with multibyte support.
     *
     * @param string $pattern
     * @param string $replacement
     * @param string $option
     * @return Stringy
     */
    public function eregReplace(string $pattern, string $replacement, string $option = 'msr'): self
    {
        $this->string = mb_ereg_replace($pattern, $replacement, $this->string, $option);
        return $this;
    }

    /**
     * Returns start point for next regular expression match.
     *
     * @return int
     */
    public function mb_ereg_search_getpos()
    {
        return mb_ereg_search_getpos($this->string);
        return $this;
    }

    /**
     * Retrieve the result from the last multibyte regular expression match.
     *
     * @return false|string[]
     */
    public function mb_ereg_search_getregs()
    {
        return mb_ereg_search_getregs($this->string);
        return $this;
    }

    /**
     * Setup string and regular expression for a multibyte regular expression match.
     *
     * @return bool
     */
    public function mb_ereg_search_init()
    {
        return mb_ereg_search_init($this->string);
        return $this;
    }

    /**
     * Returns position and length of a matched part of the multibyte regular expression for a predefined multibyte string.
     *
     * @return false|int[]
     */
    public function mb_ereg_search_pos()
    {
        return mb_ereg_search_pos($this->string);
        return $this;
    }

    /**
     * Returns the matched part of a multibyte regular expression.
     *
     * @return false|string[]
     */
    public function mb_ereg_search_regs()
    {
        return mb_ereg_search_regs($this->string);
        return $this;
    }

    /**
     * Set start point of next regular expression match.
     *
     * @return bool
     */
    public function mb_ereg_search_setpos()
    {
        return mb_ereg_search_setpos($this->string);
        return $this;
    }

    /**
     * Multibyte regular expression match for predefined multibyte string.
     *
     * @return bool
     */
    public function mb_ereg_search()
    {
        return mb_ereg_search($this->string);
        return $this;
    }

    /**
     * Regular expression match with multibyte support.
     *
     * @return int
     */
    public function mb_ereg()
    {
        return mb_ereg($this->string);
        return $this;
    }

    /**
     * Replace regular expression with multibyte support ignoring case.
     *
     * @return false|string
     */
    public function mb_eregi_replace()
    {
        return mb_eregi_replace($this->string);
        return $this;
    }

    /**
     * Regular expression match ignoring case with multibyte support.
     *
     * @return int
     */
    public function mb_eregi()
    {
        return mb_eregi($this->string);
        return $this;
    }

    /**
     * Get internal settings of mbstring.
     *
     * @return array|mixed
     */
    public function mb_get_info()
    {
        return mb_get_info($this->string);
        return $this;
    }

    /**
     * Detect HTTP input character encoding.
     *
     * @return false|string
     */
    public function mb_http_input()
    {
        return mb_http_input($this->string);
        return $this;
    }

    /**
     * Set/Get HTTP output character encoding.
     *
     * @return bool|string
     */
    public function mb_http_output()
    {
        return mb_http_output($this->string);
        return $this;
    }

    /**
     * Set/Get internal character encoding.
     *
     * @return bool|string
     */
    public function mb_internal_encoding()
    {
        return mb_internal_encoding($this->string);
        return $this;
    }

    /**
     * Set/Get current language.
     *
     * @return bool|string
     */
    public function mb_language()
    {
        return mb_language($this->string);
        return $this;
    }

    /**
     * Returns an array of all supported encodings.
     *
     * @return string[]
     */
    public function mb_list_encodings()
    {
        return mb_list_encodings($this->string);
        return $this;
    }

    /**
     * Get code point of character.
     *
     * @return false|int
     */
    public function mb_ord()
    {
        return mb_ord($this->string);
        return $this;
    }

    /**
     * Callback function converts character encoding in output buffer.
     *
     * @return string
     */
    public function mb_output_handler()
    {
        return mb_output_handler($this->string);
        return $this;
    }

    /**
     * Parse GET/POST/COOKIE data and set global variable.
     *
     * @return bool
     */
    public function mb_parse_str()
    {
        return mb_parse_str($this->string);
        return $this;
    }

    /**
     * Get MIME charset string.
     *
     * @return string
     */
    public function mb_preferred_mime_name()
    {
        return mb_preferred_mime_name($this->string);
        return $this;
    }

    /**
     * Set/Get character encoding for multibyte regex.
     *
     * @return bool|string
     */
    public function mb_regex_encoding()
    {
        return mb_regex_encoding($this->string);
        return $this;
    }

    /**
     * Set/Get the default options for mbregex functions.
     *
     * @return string
     */
    public function mb_regex_set_options()
    {
        return mb_regex_set_options($this->string);
        return $this;
    }

    /**
     * Description.
     *
     * @return false|string
     */
    public function mb_scrub()
    {
        return mb_scrub($this->string);
        return $this;
    }

    /**
     * Send encoded mail.
     *
     * @return bool
     */
    public function mb_send_mail()
    {
        return mb_send_mail($this->string);
        return $this;
    }

    /**
     * Split multibyte string using regular expression.
     *
     * @return string[]
     */
    public function mb_split()
    {
        return mb_split($this->string);
        return $this;
    }

    /**
     * Get part of string.
     *
     * @return string
     */
    public function mb_strcut()
    {
        return mb_strcut($this->string);
        return $this;
    }

    /**
     * Get truncated string with specified width.
     *
     * @return string
     */
    public function mb_strimwidth()
    {
        return mb_strimwidth($this->string);
        return $this;
    }

    /**
     * Finds position of first occurrence of a string within another, case insensitive.
     *
     * @return false|int
     */
    public function mb_stripos()
    {
        return mb_stripos($this->string);
        return $this;
    }

    /**
     * Finds first occurrence of a string within another, case insensitive.
     *
     * @return false|string
     */
    public function mb_stristr()
    {
        return mb_stristr($this->string);
        return $this;
    }

    /**
     * Get string length.
     *
     * @return int
     */
    public function mb_strlen()
    {
        return mb_strlen($this->string);
        return $this;
    }

    /**
     * Find position of first occurrence of string in a string.
     *
     * @return false|int
     */
    public function mb_strpos()
    {
        return mb_strpos($this->string);
        return $this;
    }

    /**
     * Finds the last occurrence of a character in a string within another.
     *
     * @return false|string
     */
    public function mb_strrchr()
    {
        return mb_strrchr($this->string);
        return $this;
    }

    /**
     * Finds the last occurrence of a character in a string within another, case insensitive.
     *
     * @return false|string
     */
    public function mb_strrichr()
    {
        return mb_strrichr($this->string);
        return $this;
    }

    /**
     * Finds position of last occurrence of a string within another, case insensitive.
     *
     * @return false|int
     */
    public function mb_strripos()
    {
        return mb_strripos($this->string);
        return $this;
    }

    /**
     * Find position of last occurrence of a string in a string.
     *
     * @return false|int
     */
    public function mb_strrpos()
    {
        return mb_strrpos($this->string);
        return $this;
    }

    /**
     * Finds first occurrence of a string within another.
     *
     * @return false|string
     */
    public function mb_strstr()
    {
        return mb_strstr($this->string);
        return $this;
    }

    /**
     * Make a string lowercase.
     *
     * @return string
     */
    public function mb_strtolower()
    {
        return mb_strtolower($this->string);
        return $this;
    }

    /**
     * Make a string uppercase.
     *
     * @return string
     */
    public function mb_strtoupper()
    {
        return mb_strtoupper($this->string);
        return $this;
    }

    /**
     * Return width of string.
     *
     * @return int
     */
    public function mb_strwidth()
    {
        return mb_strwidth($this->string);
        return $this;
    }

    /**
     * Set/Get substitution character.
     *
     * @return bool|int|string
     */
    public function mb_substitute_character()
    {
        return mb_substitute_character($this->string);
        return $this;
    }

    /**
     * Count the number of substring occurrences.
     *
     * @return int
     */
    public function mb_substr_count()
    {
        return mb_substr_count($this->string);
        return $this;
    }

    /**
     * Get part of string.
     *
     * @return string
     */
    public function mb_substr()
    {
        return mb_substr($this->string);
        return $this;
    }

    // regular expressions

    /**
     * Perform a regular expression search and replace
     */
    public function preg_filter(): self
    {
        $this->string = preg_filter($this->string);
        return $this;
    }

    /**
     * Return array entries that match the pattern
     */
    public function preg_grep(): self
    {
        $this->string = preg_grep($this->string);
        return $this;
    }

    /**
     * Returns the error code of the last PCRE regex execution
     */
    public function preg_last_error(): self
    {
        $this->string = preg_last_error($this->string);
        return $this;
    }

    /**
     * Perform a global regular expression match
     */
    public function preg_match_all(): self
    {
        $this->string = preg_match_all($this->string);
        return $this;
    }

    /**
     * Perform a regular expression match
     */
    public function preg_match(): self
    {
        $this->string = preg_match($this->string);
        return $this;
    }

    /**
     * Quote regular expression characters
     */
    public function preg_quote(): self
    {
        $this->string = preg_quote($this->string);
        return $this;
    }

    /**
     * Perform a regular expression search and replace using callbacks
     */
    public function preg_replace_callback_array(): self
    {
        $this->string = preg_replace_callback_array($this->string);
        return $this;
    }

    /**
     * Perform a regular expression search and replace using a callback
     */
    public function preg_replace_callback(): self
    {
        $this->string = preg_replace_callback($this->string);
        return $this;
    }

    /**
     * Perform a regular expression search and replace
     */
    public function preg_replace(): self
    {
        $this->string = preg_replace($this->string);
        return $this;
    }

    /**
     * Split string by a regular expression
     */
    public function preg_split(): self
    {
        $this->string = preg_split($this->string);
        return $this;
    }

    // extra functions

    /**
     * @param string $substring
     * @return int[]
     */
    public function getPositionsOfSubstring(string $substring): array
    {
        $substring = new self($substring);

        $position = 0;
        $positions = [];
        while (($position = $this->pos($substring, $position)) !== false) {
            $positions[] = $position;
            $position += $substring->length();
        }
        return $positions;
    }

    /**
     * @param string $from
     * @param string $to
     * @return Stringy
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

        $conversionFunction = \Safe\sprintf('%s2%s', $from, $to);
        $this->string = $conversionFunction($this->string);

        return $this;
    }

    /**
     * @param string $from
     * @return Stringy
     */
    private function toKebab(string $from): self
    {
        if ($from === self::CASE_SNAKE) {
            return $this->replace('_', '-');
        }

        if ($from === self::CASE_PASCAL) {
            $this->lowercaseFirst();
        }

        return $this->pregReplace('/([A-Z])/', '-$1')->toLower();
    }

    /**
     * @param string $from
     * @param string $to
     * @return Stringy
     */
    public function convertCase(string $from, string $to): self
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

        if ($from !== self::CASE_KEBAB) {
            $this->toKebab();
        }

        if ($to === self::CASE_KEBAB) {
            return $this;
        }

        if ($to === self::CASE_SNAKE) {
            return $this->replace('-', '_');
        }

        $positions = $this->getPositionsOfSubstring('-');
        if (count($positions) > 0) {
            foreach ($positions as $position) {
                $this->string[$position + 1] = mb_strtoupper($this->string[$position + 1]);
            }
        }

        if ($to === self::CASE_PASCAL) {
            $this->uppercaseFirst();
        }

        return $this->replace('-', '');
    }

    /**
     * @param string $value
     * @return string
     */
    public static function dotNotationToCamelCase(string $value): string
    {
        $positions = self::getPositionsOfSubstring($value, '.');
        if (count($positions) > 0) {
            foreach ($positions as $position) {
                $value[$position + 1] = strtoupper($value[$position + 1]);
            }
        }
        /** @var string $string */
        $string = str_replace('.', '', $value);

        return $string;
    }
}
