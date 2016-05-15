<?php

if (! function_exists('is_local_or_s3')) {
    function is_local_or_s3()
    {
        return (env('FILESYSTEM_DEFAULT') == 'local') ? 'public/' : '';
    }
}
