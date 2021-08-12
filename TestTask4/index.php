<?php

use Database\DB;

function loadUsersData(string $user_ids)
{

    $user_ids = explode(',', $user_ids);

    $users = DB::whereIn($user_ids);

    return $users;
}

function render($data)
{

    foreach ($data as $uid => $name) {
        echo <<<HTML
   <a href="show_user.php?id=$uid">$name</a>
HTML;
    }
}

// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
$data = loadUsersData($_GET['user_ids']);
render($data);
