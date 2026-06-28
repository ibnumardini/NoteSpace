<?php

function is_active(string $path): string
{
    $current = service('uri')->getPath();
    $current = trim(str_replace('index.php', '', $current), '/');
    $path    = trim($path, '/');

    return $current === $path ? 'active' : '';
}
