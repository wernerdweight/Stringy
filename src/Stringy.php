<?php
declare(strict_types=1);

namespace WernerDweight\Stringy;

class Stringy
{
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
     * @return string
     */
    public function addcslashes()
    {
        return addcslashes($this->string);
    }

    /**
     * Quote string with slashes.
     *
     * @return string
     */
    public function addslashes()
    {
        return addslashes($this->string);
    }

    /**
     * Convert binary data into hexadecimal representation.
     *
     * @return string
     */
    public function bin2hex()
    {
        return bin2hex($this->string);
    }

    /**
     * Alias of rtrim.
     *
     * @return string
     */
    public function chop()
    {
        return chop($this->string);
    }

    /**
     * Generate a single-byte string from a number.
     *
     * @return string
     */
    public function chr()
    {
        return chr($this->string);
    }

    /**
     * Split a string into smaller chunks.
     *
     * @return string
     */
    public function chunk_split()
    {
        return chunk_split($this->string);
    }

    /**
     * Convert from one Cyrillic character set to another.
     *
     * @return string
     */
    public function convert_cyr_string()
    {
        return convert_cyr_string($this->string);
    }

    /**
     * Decode a uuencoded string.
     *
     * @return string
     */
    public function convert_uudecode()
    {
        return convert_uudecode($this->string);
    }

    /**
     * Uuencode a string.
     *
     * @return string
     */
    public function convert_uuencode()
    {
        return convert_uuencode($this->string);
    }

    /**
     * Return information about characters used in a string.
     *
     * @return mixed
     */
    public function count_chars()
    {
        return count_chars($this->string);
    }

    /**
     * Calculates the crc32 polynomial of a string.
     *
     * @return int
     */
    public function crc32()
    {
        return crc32($this->string);
    }

    /**
     * One-way string hashing.
     *
     * @return string
     */
    public function crypt()
    {
        return crypt($this->string);
    }

    /**
     * Split a string by a string.
     *
     * @return array
     */
    public function explode()
    {
        return explode($this->string);
    }

    /**
     * Write a formatted string to a stream.
     *
     * @return int
     */
    public function fprintf()
    {
        return fprintf($this->string);
    }

    /**
     * Returns the translation table used by htmlspecialchars and htmlentities.
     *
     * @return array
     */
    public function get_html_translation_table()
    {
        return get_html_translation_table($this->string);
    }

    /**
     * Convert logical Hebrew text to visual text.
     *
     * @return string
     */
    public function hebrev()
    {
        return hebrev($this->string);
    }

    /**
     * Convert logical Hebrew text to visual text with newline conversion.
     *
     * @return string
     */
    public function hebrevc()
    {
        return hebrevc($this->string);
    }

    /**
     * Decodes a hexadecimally encoded binary string.
     *
     * @return bool|string
     */
    public function hex2bin()
    {
        return hex2bin($this->string);
    }

    /**
     * Convert HTML entities to their corresponding characters.
     *
     * @return string
     */
    public function html_entity_decode()
    {
        return html_entity_decode($this->string);
    }

    /**
     * Convert all applicable characters to HTML entities.
     *
     * @return string
     */
    public function htmlentities()
    {
        return htmlentities($this->string);
    }

    /**
     * Convert special HTML entities back to characters.
     *
     * @return string
     */
    public function htmlspecialchars_decode()
    {
        return htmlspecialchars_decode($this->string);
    }

    /**
     * Convert special characters to HTML entities.
     *
     * @return string
     */
    public function htmlspecialchars()
    {
        return htmlspecialchars($this->string);
    }

    /**
     * Join array elements with a string.
     *
     * @return string
     */
    public function implode()
    {
        return implode($this->string);
    }

    /**
     * Alias of implode.
     *
     * @return string
     */
    public function join()
    {
        return join($this->string);
    }

    /**
     * Make a string's first character lowercase.
     *
     * @return string
     */
    public function lcfirst()
    {
        return lcfirst($this->string);
    }

    /**
     * Calculate Levenshtein distance between two strings.
     *
     * @return int
     */
    public function levenshtein()
    {
        return levenshtein($this->string);
    }

    /**
     * Get numeric formatting information.
     *
     * @return array
     */
    public function localeconv()
    {
        return localeconv($this->string);
    }

    /**
     * Strip whitespace (or other characters) from the beginning of a string.
     *
     * @return string
     */
    public function ltrim()
    {
        return ltrim($this->string);
    }

    /**
     * Calculates the md5 hash of a given file.
     *
     * @return string
     */
    public function md5_file()
    {
        return md5_file($this->string);
    }

    /**
     * Calculate the md5 hash of a string.
     *
     * @return string
     */
    public function md5()
    {
        return md5($this->string);
    }

    /**
     * Calculate the metaphone key of a string.
     *
     * @return bool|string
     */
    public function metaphone()
    {
        return metaphone($this->string);
    }

    /**
     * Formats a number as a currency string.
     *
     * @return string
     */
    public function money_format()
    {
        return money_format($this->string);
    }

    /**
     * Query language and locale information.
     *
     * @return string
     */
    public function nl_langinfo()
    {
        return nl_langinfo($this->string);
    }

    /**
     * Inserts HTML line breaks before all newlines in a string.
     *
     * @return string
     */
    public function nl2br()
    {
        return nl2br($this->string);
    }

    /**
     * Format a number with grouped thousands.
     *
     * @return string
     */
    public function number_format()
    {
        return number_format($this->string);
    }

    /**
     * Convert the first byte of a string to a value between 0 and 255.
     *
     * @return int
     */
    public function ord()
    {
        return ord($this->string);
    }

    /**
     * Parses the string into variables.
     */
    public function parse_str()
    {
        return parse_str($this->string);
    }

    /**
     * Output a string.
     *
     * @return int
     */
    public function print()
    {
        return print $this->string;
    }

    /**
     * Output a formatted string.
     *
     * @return int
     */
    public function printf()
    {
        return printf($this->string);
    }

    /**
     * Convert a quoted-printable string to an 8 bit string.
     *
     * @return string
     */
    public function quoted_printable_decode()
    {
        return quoted_printable_decode($this->string);
    }

    /**
     * Convert a 8 bit string to a quoted-printable string.
     *
     * @return string
     */
    public function quoted_printable_encode()
    {
        return quoted_printable_encode($this->string);
    }

    /**
     * Quote meta characters.
     *
     * @return string
     */
    public function quotemeta()
    {
        return quotemeta($this->string);
    }

    /**
     * Strip whitespace (or other characters) from the end of a string.
     *
     * @return string
     */
    public function rtrim()
    {
        return rtrim($this->string);
    }

    /**
     * Set locale information.
     *
     * @return string
     */
    public function setlocale()
    {
        return setlocale($this->string);
    }

    /**
     * Calculate the sha1 hash of a file.
     *
     * @return string
     */
    public function sha1_file()
    {
        return sha1_file($this->string);
    }

    /**
     * Calculate the sha1 hash of a string.
     *
     * @return string
     */
    public function sha1()
    {
        return sha1($this->string);
    }

    /**
     * Calculate the similarity between two strings.
     *
     * @return int
     */
    public function similar_text()
    {
        return similar_text($this->string);
    }

    /**
     * Calculate the soundex key of a string.
     *
     * @return string
     */
    public function soundex()
    {
        return soundex($this->string);
    }

    /**
     * Return a formatted string.
     *
     * @return string
     */
    public function sprintf()
    {
        return sprintf($this->string);
    }

    /**
     * Parses input from a string according to a format.
     *
     * @return mixed
     */
    public function sscanf()
    {
        return sscanf($this->string);
    }

    /**
     * Parse a CSV string into an array.
     *
     * @return array
     */
    public function str_getcsv()
    {
        return str_getcsv($this->string);
    }

    /**
     * Case-insensitive version of str_replace.
     *
     * @return mixed
     */
    public function str_ireplace()
    {
        return str_ireplace($this->string);
    }

    /**
     * Pad a string to a certain length with another string.
     *
     * @return string
     */
    public function str_pad()
    {
        return str_pad($this->string);
    }

    /**
     * Repeat a string.
     *
     * @return string
     */
    public function str_repeat()
    {
        return str_repeat($this->string);
    }

    /**
     * Replace all occurrences of the search string with the replacement string.
     *
     * @return mixed
     */
    public function str_replace()
    {
        return str_replace($this->string);
    }

    /**
     * Perform the rot13 transform on a string.
     *
     * @return string
     */
    public function str_rot13()
    {
        return str_rot13($this->string);
    }

    /**
     * Randomly shuffles a string.
     *
     * @return string
     */
    public function str_shuffle()
    {
        return str_shuffle($this->string);
    }

    /**
     * Convert a string to an array.
     *
     * @return array
     */
    public function str_split()
    {
        return str_split($this->string);
    }

    /**
     * Return information about words used in a string.
     *
     * @return mixed
     */
    public function str_word_count()
    {
        return str_word_count($this->string);
    }

    /**
     * Binary safe case-insensitive string comparison.
     *
     * @return int|\lt
     */
    public function strcasecmp()
    {
        return strcasecmp($this->string);
    }

    /**
     * Alias of strstr.
     *
     * @return string
     */
    public function strchr()
    {
        return strchr($this->string);
    }

    /**
     * Binary safe string comparison.
     *
     * @return int|\lt
     */
    public function strcmp()
    {
        return strcmp($this->string);
    }

    /**
     * Locale based string comparison.
     *
     * @return int|\lt
     */
    public function strcoll()
    {
        return strcoll($this->string);
    }

    /**
     * Find length of initial segment not matching mask.
     *
     * @return int
     */
    public function strcspn()
    {
        return strcspn($this->string);
    }

    /**
     * Strip HTML and PHP tags from a string.
     *
     * @return string
     */
    public function strip_tags()
    {
        return strip_tags($this->string);
    }

    /**
     * Un-quote string quoted with addcslashes.
     *
     * @return string
     */
    public function stripcslashes()
    {
        return stripcslashes($this->string);
    }

    /**
     * Find the position of the first occurrence of a case-insensitive substring in a string.
     *
     * @return int
     */
    public function stripos()
    {
        return stripos($this->string);
    }

    /**
     * Un-quotes a quoted string.
     *
     * @return string
     */
    public function stripslashes()
    {
        return stripslashes($this->string);
    }

    /**
     * Case-insensitive strstr.
     *
     * @return string
     */
    public function stristr()
    {
        return stristr($this->string);
    }

    /**
     * Get string length.
     *
     * @return int
     */
    public function strlen()
    {
        return strlen($this->string);
    }

    /**
     * Case insensitive string comparisons using a "natural order" algorithm.
     *
     * @return int
     */
    public function strnatcasecmp()
    {
        return strnatcasecmp($this->string);
    }

    /**
     * String comparisons using a "natural order" algorithm.
     *
     * @return int
     */
    public function strnatcmp()
    {
        return strnatcmp($this->string);
    }

    /**
     * Binary safe case-insensitive string comparison of the first n characters.
     *
     * @return int|\lt
     */
    public function strncasecmp()
    {
        return strncasecmp($this->string);
    }

    /**
     * Binary safe string comparison of the first n characters.
     *
     * @return int|\lt
     */
    public function strncmp()
    {
        return strncmp($this->string);
    }

    /**
     * Search a string for any of a set of characters.
     *
     * @return string
     */
    public function strpbrk()
    {
        return strpbrk($this->string);
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     *
     * @return bool|int
     */
    public function strpos()
    {
        return strpos($this->string);
    }

    /**
     * Find the last occurrence of a character in a string.
     *
     * @return string
     */
    public function strrchr()
    {
        return strrchr($this->string);
    }

    /**
     * Reverse a string.
     *
     * @return string
     */
    public function strrev()
    {
        return strrev($this->string);
    }

    /**
     * Find the position of the last occurrence of a case-insensitive substring in a string.
     *
     * @return int
     */
    public function strripos()
    {
        return strripos($this->string);
    }

    /**
     * Find the position of the last occurrence of a substring in a string.
     *
     * @return bool|int
     */
    public function strrpos()
    {
        return strrpos($this->string);
    }

    /**
     * Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask.
     *
     * @return int
     */
    public function strspn()
    {
        return strspn($this->string);
    }

    /**
     * Find the first occurrence of a string.
     *
     * @return string
     */
    public function strstr()
    {
        return strstr($this->string);
    }

    /**
     * Tokenize string.
     *
     * @return string
     */
    public function strtok()
    {
        return strtok($this->string);
    }

    /**
     * Make a string lowercase.
     *
     * @return string
     */
    public function strtolower()
    {
        return strtolower($this->string);
    }

    /**
     * Make a string uppercase.
     *
     * @return string
     */
    public function strtoupper()
    {
        return strtoupper($this->string);
    }

    /**
     * Translate characters or replace substrings.
     *
     * @return string
     */
    public function strtr()
    {
        return strtr($this->string);
    }

    /**
     * Binary safe comparison of two strings from an offset, up to length characters.
     *
     * @return int|\lt
     */
    public function substr_compare()
    {
        return substr_compare($this->string);
    }

    /**
     * Count the number of substring occurrences.
     *
     * @return int
     */
    public function substr_count()
    {
        return substr_count($this->string);
    }

    /**
     * Replace text within a portion of a string.
     *
     * @return mixed
     */
    public function substr_replace()
    {
        return substr_replace($this->string);
    }

    /**
     * Return part of a string.
     *
     * @return bool|string
     */
    public function substr()
    {
        return substr($this->string);
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of a string.
     *
     * @return string
     */
    public function trim()
    {
        return trim($this->string);
    }

    /**
     * Make a string's first character uppercase.
     *
     * @return string
     */
    public function ucfirst()
    {
        return ucfirst($this->string);
    }

    /**
     * Uppercase the first character of each word in a string.
     *
     * @return string
     */
    public function ucwords()
    {
        return ucwords($this->string);
    }

    /**
     * Write a formatted string to a stream.
     *
     * @return int
     */
    public function vfprintf()
    {
        return vfprintf($this->string);
    }

    /**
     * Output a formatted string.
     *
     * @return int
     */
    public function vprintf()
    {
        return vprintf($this->string);
    }

    /**
     * Return a formatted string.
     *
     * @return string
     */
    public function vsprintf()
    {
        return vsprintf($this->string);
    }

    /**
     * Wraps a string to a given number of characters.
     *
     * @return string
     */
    public function wordwrap()
    {
        return wordwrap($this->string);
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
    }

    /**
     * Get a specific character.
     *
     * @return false|string
     */
    public function mb_chr()
    {
        return mb_chr($this->string);
    }

    /**
     * Perform case folding on a string.
     *
     * @return string
     */
    public function mb_convert_case()
    {
        return mb_convert_case($this->string);
    }

    /**
     * Convert character encoding.
     *
     * @return string
     */
    public function mb_convert_encoding()
    {
        return mb_convert_encoding($this->string);
    }

    /**
     * Convert "kana" one from another ("zen-kaku", "han-kaku" and more).
     *
     * @return string
     */
    public function mb_convert_kana()
    {
        return mb_convert_kana($this->string);
    }

    /**
     * Convert character code in variable(s).
     *
     * @return false|string
     */
    public function mb_convert_variables()
    {
        return mb_convert_variables($this->string);
    }

    /**
     * Decode string in MIME header field.
     *
     * @return string
     */
    public function mb_decode_mimeheader()
    {
        return mb_decode_mimeheader($this->string);
    }

    /**
     * Decode HTML numeric string reference to character.
     *
     * @return string
     */
    public function mb_decode_numericentity()
    {
        return mb_decode_numericentity($this->string);
    }

    /**
     * Detect character encoding.
     *
     * @return false|string
     */
    public function mb_detect_encoding()
    {
        return mb_detect_encoding($this->string);
    }

    /**
     * Set/Get character encoding detection order.
     *
     * @return bool|string[]
     */
    public function mb_detect_order()
    {
        return mb_detect_order($this->string);
    }

    /**
     * Encode string for MIME header.
     *
     * @return string
     */
    public function mb_encode_mimeheader()
    {
        return mb_encode_mimeheader($this->string);
    }

    /**
     * Encode character to HTML numeric string reference.
     *
     * @return string
     */
    public function mb_encode_numericentity()
    {
        return mb_encode_numericentity($this->string);
    }

    /**
     * Get aliases of a known encoding type.
     *
     * @return false|string[]
     */
    public function mb_encoding_aliases()
    {
        return mb_encoding_aliases($this->string);
    }

    /**
     * Regular expression match for multibyte string.
     *
     * @return bool
     */
    public function mb_ereg_match()
    {
        return mb_ereg_match($this->string);
    }

    /**
     * Perform a regular expression search and replace with multibyte support using a callback.
     *
     * @return false|string
     */
    public function mb_ereg_replace_callback()
    {
        return mb_ereg_replace_callback($this->string);
    }

    /**
     * Replace regular expression with multibyte support.
     *
     * @return false|string
     */
    public function mb_ereg_replace()
    {
        return mb_ereg_replace($this->string);
    }

    /**
     * Returns start point for next regular expression match.
     *
     * @return int
     */
    public function mb_ereg_search_getpos()
    {
        return mb_ereg_search_getpos($this->string);
    }

    /**
     * Retrieve the result from the last multibyte regular expression match.
     *
     * @return false|string[]
     */
    public function mb_ereg_search_getregs()
    {
        return mb_ereg_search_getregs($this->string);
    }

    /**
     * Setup string and regular expression for a multibyte regular expression match.
     *
     * @return bool
     */
    public function mb_ereg_search_init()
    {
        return mb_ereg_search_init($this->string);
    }

    /**
     * Returns position and length of a matched part of the multibyte regular expression for a predefined multibyte string.
     *
     * @return false|int[]
     */
    public function mb_ereg_search_pos()
    {
        return mb_ereg_search_pos($this->string);
    }

    /**
     * Returns the matched part of a multibyte regular expression.
     *
     * @return false|string[]
     */
    public function mb_ereg_search_regs()
    {
        return mb_ereg_search_regs($this->string);
    }

    /**
     * Set start point of next regular expression match.
     *
     * @return bool
     */
    public function mb_ereg_search_setpos()
    {
        return mb_ereg_search_setpos($this->string);
    }

    /**
     * Multibyte regular expression match for predefined multibyte string.
     *
     * @return bool
     */
    public function mb_ereg_search()
    {
        return mb_ereg_search($this->string);
    }

    /**
     * Regular expression match with multibyte support.
     *
     * @return int
     */
    public function mb_ereg()
    {
        return mb_ereg($this->string);
    }

    /**
     * Replace regular expression with multibyte support ignoring case.
     *
     * @return false|string
     */
    public function mb_eregi_replace()
    {
        return mb_eregi_replace($this->string);
    }

    /**
     * Regular expression match ignoring case with multibyte support.
     *
     * @return int
     */
    public function mb_eregi()
    {
        return mb_eregi($this->string);
    }

    /**
     * Get internal settings of mbstring.
     *
     * @return array|mixed
     */
    public function mb_get_info()
    {
        return mb_get_info($this->string);
    }

    /**
     * Detect HTTP input character encoding.
     *
     * @return false|string
     */
    public function mb_http_input()
    {
        return mb_http_input($this->string);
    }

    /**
     * Set/Get HTTP output character encoding.
     *
     * @return bool|string
     */
    public function mb_http_output()
    {
        return mb_http_output($this->string);
    }

    /**
     * Set/Get internal character encoding.
     *
     * @return bool|string
     */
    public function mb_internal_encoding()
    {
        return mb_internal_encoding($this->string);
    }

    /**
     * Set/Get current language.
     *
     * @return bool|string
     */
    public function mb_language()
    {
        return mb_language($this->string);
    }

    /**
     * Returns an array of all supported encodings.
     *
     * @return string[]
     */
    public function mb_list_encodings()
    {
        return mb_list_encodings($this->string);
    }

    /**
     * Get code point of character.
     *
     * @return false|int
     */
    public function mb_ord()
    {
        return mb_ord($this->string);
    }

    /**
     * Callback function converts character encoding in output buffer.
     *
     * @return string
     */
    public function mb_output_handler()
    {
        return mb_output_handler($this->string);
    }

    /**
     * Parse GET/POST/COOKIE data and set global variable.
     *
     * @return bool
     */
    public function mb_parse_str()
    {
        return mb_parse_str($this->string);
    }

    /**
     * Get MIME charset string.
     *
     * @return string
     */
    public function mb_preferred_mime_name()
    {
        return mb_preferred_mime_name($this->string);
    }

    /**
     * Set/Get character encoding for multibyte regex.
     *
     * @return bool|string
     */
    public function mb_regex_encoding()
    {
        return mb_regex_encoding($this->string);
    }

    /**
     * Set/Get the default options for mbregex functions.
     *
     * @return string
     */
    public function mb_regex_set_options()
    {
        return mb_regex_set_options($this->string);
    }

    /**
     * Description.
     *
     * @return false|string
     */
    public function mb_scrub()
    {
        return mb_scrub($this->string);
    }

    /**
     * Send encoded mail.
     *
     * @return bool
     */
    public function mb_send_mail()
    {
        return mb_send_mail($this->string);
    }

    /**
     * Split multibyte string using regular expression.
     *
     * @return string[]
     */
    public function mb_split()
    {
        return mb_split($this->string);
    }

    /**
     * Get part of string.
     *
     * @return string
     */
    public function mb_strcut()
    {
        return mb_strcut($this->string);
    }

    /**
     * Get truncated string with specified width.
     *
     * @return string
     */
    public function mb_strimwidth()
    {
        return mb_strimwidth($this->string);
    }

    /**
     * Finds position of first occurrence of a string within another, case insensitive.
     *
     * @return false|int
     */
    public function mb_stripos()
    {
        return mb_stripos($this->string);
    }

    /**
     * Finds first occurrence of a string within another, case insensitive.
     *
     * @return false|string
     */
    public function mb_stristr()
    {
        return mb_stristr($this->string);
    }

    /**
     * Get string length.
     *
     * @return int
     */
    public function mb_strlen()
    {
        return mb_strlen($this->string);
    }

    /**
     * Find position of first occurrence of string in a string.
     *
     * @return false|int
     */
    public function mb_strpos()
    {
        return mb_strpos($this->string);
    }

    /**
     * Finds the last occurrence of a character in a string within another.
     *
     * @return false|string
     */
    public function mb_strrchr()
    {
        return mb_strrchr($this->string);
    }

    /**
     * Finds the last occurrence of a character in a string within another, case insensitive.
     *
     * @return false|string
     */
    public function mb_strrichr()
    {
        return mb_strrichr($this->string);
    }

    /**
     * Finds position of last occurrence of a string within another, case insensitive.
     *
     * @return false|int
     */
    public function mb_strripos()
    {
        return mb_strripos($this->string);
    }

    /**
     * Find position of last occurrence of a string in a string.
     *
     * @return false|int
     */
    public function mb_strrpos()
    {
        return mb_strrpos($this->string);
    }

    /**
     * Finds first occurrence of a string within another.
     *
     * @return false|string
     */
    public function mb_strstr()
    {
        return mb_strstr($this->string);
    }

    /**
     * Make a string lowercase.
     *
     * @return string
     */
    public function mb_strtolower()
    {
        return mb_strtolower($this->string);
    }

    /**
     * Make a string uppercase.
     *
     * @return string
     */
    public function mb_strtoupper()
    {
        return mb_strtoupper($this->string);
    }

    /**
     * Return width of string.
     *
     * @return int
     */
    public function mb_strwidth()
    {
        return mb_strwidth($this->string);
    }

    /**
     * Set/Get substitution character.
     *
     * @return bool|int|string
     */
    public function mb_substitute_character()
    {
        return mb_substitute_character($this->string);
    }

    /**
     * Count the number of substring occurrences.
     *
     * @return int
     */
    public function mb_substr_count()
    {
        return mb_substr_count($this->string);
    }

    /**
     * Get part of string.
     *
     * @return string
     */
    public function mb_substr()
    {
        return mb_substr($this->string);
    }

    // extra functions
}
