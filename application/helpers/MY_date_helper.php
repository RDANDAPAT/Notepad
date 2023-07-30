<?php
defined('BASEPATH') or exit('No direct script access allowed');

// class MY_date_helper extends CI_Date_helper
// {

    if (!function_exists('custom_timespan')) {
        function custom_timespan($datetime)
        {
            $now = time();
            $timestamp = strtotime($datetime);

            // Calculate the difference in seconds
            $diff = abs($now - $timestamp);

            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor($diff / (30 * 60 * 60 * 24));
            $weeks = floor($diff / (7 * 60 * 60 * 24));
            $days = floor($diff / (60 * 60 * 24));
            $hours = floor($diff / (60 * 60));
            $minutes = floor($diff / 60);
            $seconds = $diff;

            if ($years > 0) {
                $timespan = $years . ' year' . ($years !== 1 ? "'s" : '') . ' ago';
            } elseif ($months > 0) {
                $timespan = $months . ' month' . ($months !== 1 ? "'s" : '') . ' ago';
            } elseif ($weeks > 0) {
                $timespan = $weeks . ' week' . ($weeks !== 1 ? "'s" : '') . ' ago';
            } elseif ($days > 0) {
                $timespan = $days . ' day' . ($days !== 1 ? "'s" : '') . ' ago';
            } elseif ($hours > 0) {
                $timespan = $hours . ' hour' . ($hours !== 1 ? "'s" : '') . ' ago';
            } elseif ($minutes > 0) {
                $timespan = $minutes . ' minute' . ($minutes !== 1 ? "'s" : '') . ' ago';
            } else {
                $timespan = $seconds . ' second' . ($seconds !== 1 ? "'s" : '') . ' ago';
            }

            return $timespan;
        }
    }
// }