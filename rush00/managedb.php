<?php
if ("/managedb.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
function create_account($login, $pass, $mail){
    if ($login !== "" && $pass !== "" && $mail !== ""){
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        if (!file_exists('.private/users')){ # CREATE DB IF THERE S NO USER;
            $user_info[$login] = array('login' => $login, 'mdp' => $pass, 'mail' => $mail);
            $user_info = serialize($user_info);
            file_put_contents('.private/users', $user_info, LOCK_EX);
            }
        else if (file_exists('.private/users')){   # ADD NEW USER;
            $data = file_get_contents('.private/users');
            $data = unserialize($data);
            if (array_key_exists($login, $data))    #USER ALREADY EXIST;
                return (FALSE);
            $data[$login] =  array('login' => $login, 'mdp' => $pass, 'mail' => $mail);
            $data = serialize($data);
            file_put_contents('.private/users', $data, LOCK_EX);
            }
        }
        return (TRUE);
    }
function auth($login, $passwd){
    if (file_exists(".private/users"))
    {
        $data = file_get_contents(".private/users");
        $data = unserialize($data);
        foreach($data as $user){
            if($user['login'] == $login){
                if(password_verify($passwd, $user['mdp']))
                    return (TRUE);
            }
        }
        return (FALSE);
    }
}
function users_array(){
    $data = file_get_contents(".private/users");
    return (unserialize($data));
}
function delete_user($user){
    $data = users_array();
    if (!isset($data[$user]['admin'])){
        unset($data[$user]);
    }
    file_put_contents('.private/users', serialize($data), LOCK_EX);
}
?>
