<?php
namespace AmitKhareSlimHMVC;

function setStatus($code=200,$msg="ok"){
	return array("code"=>$code,"msgs"=>array($msg));
}