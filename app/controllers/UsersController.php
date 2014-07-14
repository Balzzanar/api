<?php

class UsersController extends Phalcon\Mvc\Controller
{

    public function indexAction()
    {
	$users = new Users();
        $phql = "SELECT * FROM users ORDER BY users.id desc";
        $query = new Phalcon\Mvc\Model\Query($phql, $this->getDI());
        $users = $query->execute();
    
	echo $users->count();
	die("hejsan");
        $this->view->setVar("users", $users);  
        //$this->view->setVar("users", Users::find());  
    }

    public function newAction()
    {
        $users = Users::find();
        $us = array();
        foreach ($users as $user) {
            $u = array(
                    "id"            => $user->id,
                    "username"      => $user->username,
                    "pass"          => $user->pass,
                    "fullname"      => $user->fullname,
                    "cre_tm"        => $user->cre_tm
                );
            $us[] = (object)$u;
        }
        $us['count'] = count($us);
        echo json_encode($us);
        
        $this->flashsess->setCssClasses(array("success" => "banan"));
        $this->flashsess->success("All users listed!");
        
    //    return $this->dispatcher->forward(array(
     //           "controller" => "users",
     //           "action" => "index"
     //       ));
        return $this->response->redirect("users/index");
        //exit(0);    // <-- This will make it work with api calls. 
    }

    public function logoutAction()
    {
        $this->session->remove('auth');
        return $this->dispatcher->forward(array(
            'controller' => 'posts',
            'action' => 'index'
        ));
    }

    public function addAction()
    {
        /** Check if the request is a post and then if it has an index called 'user' */
        $request = new Phalcon\Http\Request();
        if ($request->isPost() == true && $request->hasPost('user')) 
        {
            $data = json_decode($request->getPost('user'));
            $user = new Users();

            $user->username = $data->saleid;
            $user->pass = $data->idcoworker;
            $user->fullname = $data->office_name;
            $user->cre_tm = 1;
            $user->save();
            echo json_encode(array("newID" => $user->id, "name" => $user->username));   
        }
        else
        {
            echo json_encode($request->getPost());   
        }

        die;
    }

}
