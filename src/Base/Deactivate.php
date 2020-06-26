<?php
/**
 * @package MRLCAA
 */

namespace CAA\Base;

class Deactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}
