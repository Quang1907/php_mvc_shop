<?php
// utilities Tiện ích
function isPost()
{
    return strtoupper($_SERVER['REQUEST_METHOD'] === 'POST');
}

function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
