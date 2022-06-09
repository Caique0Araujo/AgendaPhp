<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoGroup;
use Agenda\Models\Group;
use Agenda\Views\Groups\GroupView;

class ControllerGroup
{
    public function __construct()
    {
    }
    public function indexAll()
    {
        $groups = [];
        $dao = new DaoGroup();
        $groups = $dao->getAll($_SESSION['id']);
        $view = new GroupView();
        $view->dataContainer($groups);
    }

    public function indexOne()
    {
    }

    public function store()
    {
        $view = new GroupView();
        $view->addForm();
    }

    public function storeSave($name, $description){
        $group = new Group();

        $group->setName($name);
        $group->setDescription($description);
        $group->setUser_id($_SESSION['id']);

        $dao = new DaoGroup();
        $dao->create($group);
    }

    public function update($id)
    {
        $dao = new DaoGroup();
        $group = $dao->getById($id, $_SESSION['id']);
        $view = new GroupView();
        $view->editForm($group);
    }
    public function updateSave($id, $name, $description){
        $group = new Group();

        $group->setId($id);
        $group->setName($name);
        $group->setDescription($description);
        $group->setUser_id($_SESSION['id']);

        $dao = new DaoGroup();
        $dao->update($group);
    }
    public function delete($id)
    {
        $dao = new DaoGroup();
        $dao->delete($id, $_SESSION['id']);
    }

}
