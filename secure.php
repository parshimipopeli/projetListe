<?php
foreach ($_GET as $key => $value)
{
    $getSecure[$key] = htmlspecialchars($value);
}

foreach ($_POST as $key => $value)
{
    $postSecure[$key] = htmlspecialchars($value);
}