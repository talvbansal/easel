<?php
/**
 * Process a url and make it SEO compliant.
 *
 * @param $string
 * @return string
 */
function seoUrl($string)
{
    // Make the string lowercase
    $string = strtolower($string);
    // Make the string alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    // Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    // Convert whitespaces and underscores to dashes
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

/**
 * Return sizes readable by humans.
 *
 * @param $bytes
 * @param int $decimals
 * @return string
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

/**
 * Check if the mime type is an image.
 *
 * @param $mimeType
 * @return bool
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

/**
 * Return 'checked' if true.
 *
 * @param $value
 * @return string
 */
function checked($value)
{
    return $value ? 'checked' : '';
}

/**
 * Return the img url for headers.
 *
 * @param null $value
 * @return mixed|null|string
 */
function page_image($value = null)
{
    if (empty($value)) {
        $value = config('easel.page_image');
    }
    if (!starts_with($value, 'http') && $value[0] !== '/') {
        $value = config('easel.uploads.webpath') . '/' . $value;
    }
    return $value;
}