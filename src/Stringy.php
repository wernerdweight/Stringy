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
     * TODO:
     * Generate a single-byte string from a number.
     *
     * @return string
     */
    public function chr()
    {
        return chr($this->string);
        return $this;
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
     * @return string
     */
    public function number_format()
    {
        return number_format($this->string);
        return $this;
    }

    /**
     * Convert the first byte of a string to a value between 0 and 255.
     *
     * @return int
     */
    public function ord()
    {
        return ord($this->string);
        return $this;
    }

    /**
     * Parses the string into variables.
     */
    public function parse_str()
    {
        return parse_str($this->string);
        return $this;
    }

    /**
     * Output a string.
     *
     * @return int
     */
    public function print()
    {
        return print $this->string;
        return $this;
    }

    /**
     * Output a formatted string.
     *
     * @return int
     */
    public function printf()
    {
        return printf($this->string);
        return $this;
    }

    /**
     * Convert a quoted-printable string to an 8 bit string.
     *
     * @return string
     */
    public function quoted_printable_decode()
    {
        return quoted_printable_decode($this->string);
        return $this;
    }

    /**
     * Convert a 8 bit string to a quoted-printable string.
     *
     * @return string
     */
    public function quoted_printable_encode()
    {
        return quoted_printable_encode($this->string);
        return $this;
    }

    /**
     * Quote meta characters.
     *
     * @return string
     */
    public function quotemeta()
    {
        return quotemeta($this->string);
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the end of a string.
     *
     * @return string
     */
    public function rtrim()
    {
        return rtrim($this->string);
        return $this;
    }

    /**
     * Calculate the sha1 hash of a file.
     *
     * @return string
     */
    public function sha1_file()
    {
        return sha1_file($this->string);
        return $this;
    }

    /**
     * Calculate the sha1 hash of a string.
     *
     * @return string
     */
    public function sha1()
    {
        return sha1($this->string);
        return $this;
    }

    /**
     * Calculate the similarity between two strings.
     *
     * @return int
     */
    public function similar_text()
    {
        return similar_text($this->string);
        return $this;
    }

    /**
     * Calculate the soundex key of a string.
     *
     * @return string
     */
    public function soundex()
    {
        return soundex($this->string);
        return $this;
    }

    /**
     * Return a formatted string.
     *
     * @return string
     */
    public function sprintf()
    {
        return sprintf($this->string);
        return $this;
    }

    /**
     * Parses input from a string according to a format.
     *
     * @return mixed
     */
    public function sscanf()
    {
        return sscanf($this->string);
        return $this;
    }

    /**
     * Parse a CSV string into an array.
     *
     * @return array
     */
    public function str_getcsv()
    {
        return str_getcsv($this->string);
        return $this;
    }

    /**
     * Case-insensitive version of str_replace.
     *
     * @return mixed
     */
    public function str_ireplace()
    {
        return str_ireplace($this->string);
        return $this;
    }

    /**
     * Pad a string to a certain length with another string.
     *
     * @return string
     */
    public function str_pad()
    {
        return str_pad($this->string);
        return $this;
    }

    /**
     * Repeat a string.
     *
     * @return string
     */
    public function str_repeat()
    {
        return str_repeat($this->string);
        return $this;
    }

    /**
     * Replace all occurrences of the search string with the replacement string.
     *
     * @return mixed
     */
    public function str_replace()
    {
        return str_replace($this->string);
        return $this;
    }

    /**
     * Perform the rot13 transform on a string.
     *
     * @return string
     */
    public function str_rot13()
    {
        return str_rot13($this->string);
        return $this;
    }

    /**
     * Randomly shuffles a string.
     *
     * @return string
     */
    public function str_shuffle()
    {
        return str_shuffle($this->string);
        return $this;
    }

    /**
     * Convert a string to an array.
     *
     * @return array
     */
    public function str_split()
    {
        return str_split($this->string);
        return $this;
    }

    /**
     * Return information about words used in a string.
     *
     * @return mixed
     */
    public function str_word_count()
    {
        return str_word_count($this->string);
        return $this;
    }

    /**
     * Binary safe case-insensitive string comparison.
     *
     * @return int|\lt
     */
    public function strcasecmp()
    {
        return strcasecmp($this->string);
        return $this;
    }

    /**
     * Alias of strstr.
     *
     * @return string
     */
    public function strchr()
    {
        return strchr($this->string);
        return $this;
    }

    /**
     * Binary safe string comparison.
     *
     * @return int|\lt
     */
    public function strcmp()
    {
        return strcmp($this->string);
        return $this;
    }

    /**
     * Locale based string comparison.
     *
     * @return int|\lt
     */
    public function strcoll()
    {
        return strcoll($this->string);
        return $this;
    }

    /**
     * Find length of initial segment not matching mask.
     *
     * @return int
     */
    public function strcspn()
    {
        return strcspn($this->string);
        return $this;
    }

    /**
     * Strip HTML and PHP tags from a string.
     *
     * @return string
     */
    public function strip_tags()
    {
        return strip_tags($this->string);
        return $this;
    }

    /**
     * Un-quote string quoted with addcslashes.
     *
     * @return string
     */
    public function stripcslashes()
    {
        return stripcslashes($this->string);
        return $this;
    }

    /**
     * Find the position of the first occurrence of a case-insensitive substring in a string.
     *
     * @return int
     */
    public function stripos()
    {
        return stripos($this->string);
        return $this;
    }

    /**
     * Un-quotes a quoted string.
     *
     * @return string
     */
    public function stripslashes()
    {
        return stripslashes($this->string);
        return $this;
    }

    /**
     * Case-insensitive strstr.
     *
     * @return string
     */
    public function stristr()
    {
        return stristr($this->string);
        return $this;
    }

    /**
     * Get string length.
     *
     * @return int
     */
    public function strlen()
    {
        return strlen($this->string);
        return $this;
    }

    /**
     * Case insensitive string comparisons using a "natural order" algorithm.
     *
     * @return int
     */
    public function strnatcasecmp()
    {
        return strnatcasecmp($this->string);
        return $this;
    }

    /**
     * String comparisons using a "natural order" algorithm.
     *
     * @return int
     */
    public function strnatcmp()
    {
        return strnatcmp($this->string);
        return $this;
    }

    /**
     * Binary safe case-insensitive string comparison of the first n characters.
     *
     * @return int|\lt
     */
    public function strncasecmp()
    {
        return strncasecmp($this->string);
        return $this;
    }

    /**
     * Binary safe string comparison of the first n characters.
     *
     * @return int|\lt
     */
    public function strncmp()
    {
        return strncmp($this->string);
        return $this;
    }

    /**
     * Search a string for any of a set of characters.
     *
     * @return string
     */
    public function strpbrk()
    {
        return strpbrk($this->string);
        return $this;
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     *
     * @return bool|int
     */
    public function strpos()
    {
        return strpos($this->string);
        return $this;
    }

    /**
     * Find the last occurrence of a character in a string.
     *
     * @return string
     */
    public function strrchr()
    {
        return strrchr($this->string);
        return $this;
    }

    /**
     * Reverse a string.
     *
     * @return string
     */
    public function strrev()
    {
        return strrev($this->string);
        return $this;
    }

    /**
     * Find the position of the last occurrence of a case-insensitive substring in a string.
     *
     * @return int
     */
    public function strripos()
    {
        return strripos($this->string);
        return $this;
    }

    /**
     * Find the position of the last occurrence of a substring in a string.
     *
     * @return bool|int
     */
    public function strrpos()
    {
        return strrpos($this->string);
        return $this;
    }

    /**
     * Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask.
     *
     * @return int
     */
    public function strspn()
    {
        return strspn($this->string);
        return $this;
    }

    /**
     * Find the first occurrence of a string.
     *
     * @return string
     */
    public function strstr()
    {
        return strstr($this->string);
        return $this;
    }

    /**
     * Tokenize string.
     *
     * @return string
     */
    public function strtok()
    {
        return strtok($this->string);
        return $this;
    }

    /**
     * Make a string lowercase.
     *
     * @return string
     */
    public function strtolower()
    {
        return strtolower($this->string);
        return $this;
    }

    /**
     * Make a string uppercase.
     *
     * @return string
     */
    public function strtoupper()
    {
        return strtoupper($this->string);
        return $this;
    }

    /**
     * Translate characters or replace substrings.
     *
     * @return string
     */
    public function strtr()
    {
        return strtr($this->string);
        return $this;
    }

    /**
     * Binary safe comparison of two strings from an offset, up to length characters.
     *
     * @return int|\lt
     */
    public function substr_compare()
    {
        return substr_compare($this->string);
        return $this;
    }

    /**
     * Count the number of substring occurrences.
     *
     * @return int
     */
    public function substr_count()
    {
        return substr_count($this->string);
        return $this;
    }

    /**
     * Replace text within a portion of a string.
     *
     * @return mixed
     */
    public function substr_replace()
    {
        return substr_replace($this->string);
        return $this;
    }

    /**
     * Return part of a string.
     *
     * @return bool|string
     */
    public function substr()
    {
        return substr($this->string);
        return $this;
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of a string.
     *
     * @return string
     */
    public function trim()
    {
        return trim($this->string);
        return $this;
    }

    /**
     * Make a string's first character uppercase.
     *
     * @return string
     */
    public function ucfirst()
    {
        return ucfirst($this->string);
        return $this;
    }

    /**
     * Uppercase the first character of each word in a string.
     *
     * @return string
     */
    public function ucwords()
    {
        return ucwords($this->string);
        return $this;
    }

    /**
     * Write a formatted string to a stream.
     *
     * @return int
     */
    public function vfprintf()
    {
        return vfprintf($this->string);
        return $this;
    }

    /**
     * Output a formatted string.
     *
     * @return int
     */
    public function vprintf()
    {
        return vprintf($this->string);
        return $this;
    }

    /**
     * Return a formatted string.
     *
     * @return string
     */
    public function vsprintf()
    {
        return vsprintf($this->string);
        return $this;
    }

    /**
     * Wraps a string to a given number of characters.
     *
     * @return string
     */
    public function wordwrap()
    {
        return wordwrap($this->string);
        return $this;
    }

    // mb functions

    /**
     * Check if the string is valid for the specified encoding.
     *
     * @return bool
     */
    public function mb_check_encoding()
    {
        return mb_check_encoding($this->string);
        return $this;
    }

    /**
     * Get a specific character.
     *
     * @return false|string
     */
    public function mb_chr()
    {
        return mb_chr($this->string);
        return $this;
    }

    /**
     * Perform case folding on a string.
     *
     * @return string
     */
    public function mb_convert_case()
    {
        return mb_convert_case($this->string);
        return $this;
    }

    /**
     * Convert character encoding.
     *
     * @return string
     */
    public function mb_convert_encoding()
    {
        return mb_convert_encoding($this->string);
        return $this;
    }

    /**
     * Convert "kana" one from another ("zen-kaku", "han-kaku" and more).
     *
     * @return string
     */
    public function mb_convert_kana()
    {
        return mb_convert_kana($this->string);
        return $this;
    }

    /**
     * Convert character code in variable(s).
     *
     * @return false|string
     */
    public function mb_convert_variables()
    {
        return mb_convert_variables($this->string);
        return $this;
    }

    /**
     * Decode string in MIME header field.
     *
     * @return string
     */
    public function mb_decode_mimeheader()
    {
        return mb_decode_mimeheader($this->string);
        return $this;
    }

    /**
     * Decode HTML numeric string reference to character.
     *
     * @return string
     */
    public function mb_decode_numericentity()
    {
        return mb_decode_numericentity($this->string);
        return $this;
    }

    /**
     * Detect character encoding.
     *
     * @return false|string
     */
    public function mb_detect_encoding()
    {
        return mb_detect_encoding($this->string);
        return $this;
    }

    /**
     * Set/Get character encoding detection order.
     *
     * @return bool|string[]
     */
    public function mb_detect_order()
    {
        return mb_detect_order($this->string);
        return $this;
    }

    /**
     * Encode string for MIME header.
     *
     * @return string
     */
    public function mb_encode_mimeheader()
    {
        return mb_encode_mimeheader($this->string);
        return $this;
    }

    /**
     * Encode character to HTML numeric string reference.
     *
     * @return string
     */
    public function mb_encode_numericentity()
    {
        return mb_encode_numericentity($this->string);
        return $this;
    }

    /**
     * Get aliases of a known encoding type.
     *
     * @return false|string[]
     */
    public function mb_encoding_aliases()
    {
        return mb_encoding_aliases($this->string);
        return $this;
    }

    /**
     * Regular expression match for multibyte string.
     *
     * @return bool
     */
    public function mb_ereg_match()
    {
        return mb_ereg_match($this->string);
        return $this;
    }

    /**
     * Perform a regular expression search and replace with multibyte support using a callback.
     *
     * @return false|string
     */
    public function mb_ereg_replace_callback()
    {
        return mb_ereg_replace_callback($this->string);
        return $this;
    }

    /**
     * Replace regular expression with multibyte support.
     *
     * @return false|string
     */
    public function mb_ereg_replace()
    {
        return mb_ereg_replace($this->string);
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
