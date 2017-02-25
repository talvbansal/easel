<?php

if (!function_exists('seoUrl')) {
    /**
     * Process a url and make it SEO compliant.
     *
     * @param $string
     *
     * @return string
     */
    function seoUrl($string)
    {
        // Make the string lowercase
        $string = strtolower($string);
        // Make the string alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", '', $string);
        // Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", ' ', $string);
        // Convert whitespaces and underscores to dashes
        $string = preg_replace("/[\s_]/", '-', $string);

        return $string;
    }
}

if (!function_exists('human_filesize')) {
    /**
     * Return sizes readable by humans.
     *
     * @param     $bytes
     * @param int $decimals
     *
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).@$size[$factor];
    }
}

if (!function_exists('is_image')) {
    /**
     * Check if the mime type is an image.
     *
     * @param $mimeType
     *
     * @return bool
     */
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if (!function_exists('checked')) {
    /**
     * Return 'checked' if true.
     *
     * @param $value
     *
     * @return string
     */
    function checked($value)
    {
        return $value ? 'checked' : '';
    }
}
