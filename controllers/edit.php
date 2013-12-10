<?php

class Edit extends Controller {

    function __construct() {

        parent::__construct();
    }

    function index() {


        Admincontrols::isloggedin();
        $this->view->render('edit/index');
    }

    function addPhoto() {
        Admincontrols::isloggedin();
        $this->view->cat = $this->model->returnCategories();
        $this->view->render('edit/imageupload', true);
    }

    function uploadimage() {
        Admincontrols::isloggedin();
        $this->view->render('edit/uploadimage');
    }

    function removeimage($photoid = false) {
        
        if ($photoid) {
            //deletes the main pic

            $this->model->removeimage($photoid);
            header('Location:' . URL);
        }
    }

    function editor() {
        Admincontrols::isloggedin();
        $this->view->render('edit/editor', true);
    }

    function guiniUpdate() {
        $this->model->updateLittleBox($_POST['editor'], $_POST['id']);
        header('Location: ' . $_POST['return']);
    }

    function createNewLittleBox() {
        echo $this->model->createNewLittleBox();
    }

    function imagebrowser() {
        $this->view->images = $this->model->returnImages();
        $this->view->cats = $this->model->returnImagesCategories();
        $this->view->render('edit/imagebrowser', true);
    }

    function addevent() {

        $this->view->render('edit/addevent', true);
    }

    function setEvent() {

        $this->model->setEvent();
        header('Location:' . URL);
    }

    function removeEvent() {

        $this->model->removeEvent();
        header('Location:' . URL);
    }

    function addvideo() {
        $this->view->vcats = $this->model->returnVideoCategories();
        $this->view->render('edit/addvideo', true);
    }

    function linkvideo() {
        $this->model->linkVideo();
        header('Location:' . URL);
    }

    function unlinkVideo(){
        $this->model->ulinkVideo();
        header('Location:' . URL);
    }
}