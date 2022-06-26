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

function redirectIfNotLogged($sourceTarget = '')
{
    $_SESSION['redirectTarget'] = BASE_URL . 'index.php' . $sourceTarget;
    if (isLoggedIn()) return;
    header('Location: ' . BASE_URL . 'index.php/login');
    exit();
}
