<?php

/******************************
 * timestamp操作
 ******************************/
/**
 * timestamp整形Ymd
 *
 * @param timestamp $ts
 * @return string Y-m-d形式
 */
function toDateYmd($ts)
{
    return date('Y-m-d', $ts);
}

/**
 * timestamp整形Ymdhi
 *
 * @param timestamp $ts
 * @return string Y-m-d H:i形式
 */
function toDateYmdHi($ts)
{
    return date('Y-m-d H:i', $ts);
}

/**
 * 文字列で日付と時間を受け取ってTimeStampを返す
 *
 * @param string $ymd 2015-12-12の形で受け取る
 * @param string $hi 12:30の形で受け取る
 * @return timestamp
 */
function toTimeStamp($ymd="", $hi="")
{
    if (empty($ymd) || empty($hi)) trigger_error("empty ymd or hi!", E_USER_ERROR);
    $ymd = explode("-", $ymd);
    $hi = explode(":", $hi);

    return mktime($hi[0], $hi[1], 0, $ymd[1], $ymd[2], $ymd[0]);
}
