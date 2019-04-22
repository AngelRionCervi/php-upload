<?php

if(file_exists('uploads/'.$_POST['name'])){
	unlink('uploads/'.$_POST['name']);
}