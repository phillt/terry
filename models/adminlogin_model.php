<?php

class adminlogin_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function run() {
        $sth = $this->db->prepare("SELECT id, role FROM user WHERE 
				login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));

        $data = $sth->fetch();

        $count = $sth->rowCount();
        if ($count > 0) {
            // login
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            header('location: ../dashboard');
        } else {
            header('location: ../login');
        }
    }

    public function loginCheck() {

        //check if the remember me is set

        if (isset($_POST['remember'])) {
            $expire = time() + 60 * 60 * 24 * 30;
            setcookie("admin", true, $expire, '/');
        }
        else{
            setcookie("admin", "", time()-3600, '/');
        }


        $sth = $this->db->prepare("SELECT uid FROM philllwareusers WHERE 
				usr = :login AND pasw = :password");

        $sth->execute(array(
            ':login' => $_POST['user'],
            ':password' => $_POST['pswrd']
        ));

        $data = $sth->fetch();

        $count = $sth->rowCount();

        if ($count > 0) {

            //check if user has permision to edit this website

            $sth = $this->db->prepare("SELECT web_id FROM website_spine WHERE 
				admin_id = :uid ");
            $sth->execute(array(
                ':uid' => $data['uid']
            ));

            $datas = $sth->fetch();

            $counts = $sth->rowCount();
            if ($counts > 0) {

                if ($datas['web_id'] == WEB_ID) {



                    Session::init();
                    Session::set('uid', $data['uid']);
                    Session::set('loggedIn', true);
                    header('location: ../index');
                } else {
                    header('location: ../Adminlogisn');
                }
            }

            // login
        } else {
            header('location: ../Adminlogin');
        }
    }

    function logout() {
        Session::init();
        Session::destroy();
        header('location: '.URL.'/Adminlogin');
    }

}