<?php
/**
* Holding a instance of CChris to enable use of $this in subclasses and provide some helpers.
*
* @package ChrisCore
*/
class CObject {

/**
* Members
*/
protected $Chris;
protected $config;
protected $request;
protected $data;
protected $db;
protected $views;
protected $session;
protected $user;


/**
* Constructor, can be instantiated by sending in the $Chris reference.
*/
protected function __construct($Chris=null) {
if(!$Chris) {
$Chris = CChris::Instance();
}
$this->Chris = &$Chris;
    $this->config = &$Chris->config;
    $this->request = &$Chris->request;
    $this->data = &$Chris->data;
    $this->db = &$Chris->db;
    $this->views = &$Chris->views;
    $this->session = &$Chris->session;
    $this->user = &$Chris->user;
}


/**
* Wrapper for same method in CChris. See there for documentation.
*/
protected function RedirectTo($urlOrController=null, $method=null, $arguments=null) {
    $this->Chris->RedirectTo($urlOrController, $method, $arguments);
  }


/**
* Wrapper for same method in CChris. See there for documentation.
*/
protected function RedirectToController($method=null, $arguments=null) {
    $this->Chris->RedirectToController($method, $arguments);
  }


/**
* Wrapper for same method in CChris. See there for documentation.
*/
protected function RedirectToControllerMethod($controller=null, $method=null, $arguments=null) {
    $this->Chris->RedirectToControllerMethod($controller, $method, $arguments);
  }


/**
* Wrapper for same method in CChris. See there for documentation.
*/
  protected function AddMessage($type, $message, $alternative=null) {
    return $this->Chris->AddMessage($type, $message, $alternative);
  }


/**
* Wrapper for same method in CChris. See there for documentation.
*/
protected function CreateUrl($urlOrController=null, $method=null, $arguments=null) {
    return $this->Chris->CreateUrl($urlOrController, $method, $arguments);
  }


}
