<?php


if (!function_exists('getIconStatus')) {
    /**
     *
     *
     *
     * @param string $status
     * @return string
     */
    function getIconStatus(string $status): string
    {
        return match ($status) {
            'suspended' => 'pause',
            'finished' => 'stop',
            'ongoing' => 'play',
            default => 'question',
        };
    }
}

if (!function_exists('getIconColor')) {
    /**
     *
     *
     *
     * @param string $status
     * @return string
     */
    function getIconColor(string $status): string
    {
        return match ($status) {
            'suspended' => 'orange',
            'finished' => 'red',
            'ongoing' => 'green',
            default => 'grey',
        };
    }
}
