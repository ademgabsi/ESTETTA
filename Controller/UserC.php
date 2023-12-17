<?php
include SITE_ROOT . "/Model/User.php";
class UserC
{
    public function login($email, $password)
    {
        $db = config::getConnexion();
        $select_tutor = $db->prepare("SELECT * FROM `user` WHERE email = ? AND password = ? LIMIT 1");

        try {
            $select_tutor->execute([$email, $password]);
            return $select_tutor->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function register(User $user)
    {
        $db = config::getConnexion();
        $insert_tutor = $db->prepare("INSERT INTO `user` ( name, role, email, password, image) VALUES (?, ?, ?, ?, ?)");

        try {
            $insert_tutor->execute([$user->getName(), 2, $user->getEmail(), $user->getPassword(), $user->getImage()]);

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getByEmail($email)
    {
        $db = config::getConnexion();
        $select_tutor = $db->prepare("SELECT * FROM `user` WHERE email = ?");
        try {
            $select_tutor->execute([$email]);
            return $select_tutor->rowCount() > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function getById($id)
    {
        $db = config::getConnexion();
        $select_profile = $db->prepare("SELECT * FROM `user` WHERE id = ? LIMIT 1");
        try {
            $select_profile->execute([$id]);
            return $select_profile->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getUserIdFromCookie()
    {
        if (isset($_COOKIE['user_id'])) {
            return $_COOKIE['user_id'];
        } else {
            return '';
        }
    }

}
