<?php

use Hashids\Hashids;

if(!function_exists('hash_id'))
{
    function hash_id($id)
    {
        $hashId = new Hashids();
        return $hashId->encode($id);
    }
}

if(!function_exists('unhash_id'))
{
    function unhash_id($id)
    {
        $hashId = new Hashids();
        return $hashId->decode($id)[0];
    }
}