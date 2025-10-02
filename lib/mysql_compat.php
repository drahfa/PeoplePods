<?php
// Compatibility layer for legacy mysql_* APIs on PHP 7+/8+, implemented over mysqli.
if (!function_exists('mysql_query')) {
    if (!extension_loaded('mysqli')) {
        throw new RuntimeException('PeoplePods requires the mysqli extension when emulating mysql_* functions.');
    }

    class PeoplePodsMysqlCompat
    {
        /** @var mysqli|null */
        public static $lastConnection = null;

        public static function resolveLink($link = null)
        {
            if ($link instanceof mysqli) {
                self::$lastConnection = $link;
                return $link;
            }

            if ($link !== null) {
                return $link;
            }

            return self::$lastConnection;
        }
    }

    function mysql_pconnect($server = null, $username = null, $password = null)
    {
        $link = mysqli_connect(
            $server ?? ini_get('mysqli.default_host'),
            $username ?? ini_get('mysqli.default_user'),
            $password ?? ini_get('mysqli.default_pw')
        );
        if (!$link) {
            return false;
        }
        PeoplePodsMysqlCompat::$lastConnection = $link;
        return $link;
    }

    function mysql_select_db($database, $link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return false;
        }
        return mysqli_select_db($link, $database);
    }

    function mysql_query($query, $link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return false;
        }
        return mysqli_query($link, $query);
    }

    function mysql_real_escape_string($unescaped_string, $link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return addslashes($unescaped_string);
        }
        return mysqli_real_escape_string($link, $unescaped_string);
    }

    function mysql_fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }

    function mysql_fetch_row($result)
    {
        return mysqli_fetch_row($result);
    }

    function mysql_num_rows($result)
    {
        return mysqli_num_rows($result);
    }

    function mysql_num_fields($result)
    {
        return mysqli_num_fields($result);
    }

    function mysql_free_result($result)
    {
        if ($result instanceof mysqli_result) {
            mysqli_free_result($result);
        }
    }

    function mysql_insert_id($link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return 0;
        }
        return mysqli_insert_id($link);
    }

    function mysql_affected_rows($link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return 0;
        }
        return mysqli_affected_rows($link);
    }

    function mysql_error($link_identifier = null)
    {
        $link = PeoplePodsMysqlCompat::resolveLink($link_identifier);
        if (!$link) {
            return mysqli_connect_error();
        }
        return mysqli_error($link);
    }
}
