<?php

require_once "passwordLib.php";

$UsercsvFile = 'users.csv';
$adminFile = 'admin.csv';
class User {
	public $username = ''; /* Username */
	public $email = ''; /* Users email */
	public $hash = ''; /* Hash of password */
}
function makeNewUser($username, $hash, $email) {
	$u = new User ();
	$u->username = $username;
	$u->hash = $hash;
	$u->email = $email;
	return $u;
}

function setupDefaultUsers() {
	$users = array ();
	$i = 0;
	$users [$i ++] = makeNewUser ( 'ghatch', '$2a$10$N36HXAkyuGMyxSuDn7UFde0H4HJgrdTmjwhqwzMV4YHNdZ3bkNCxa', 'Powhound@rams.colostate.edu');
	writeUser ( $users );
}
//user.csv
function readUsers() {
if (! file_exists ( 'users.csv' )) {
		setupDefaultUsers ();
	}
	$users = array ();
	$fh = fopen ( 'users.csv', 'r' ) or die ( "Can't open file" );
	$keys = fgetcsv ( $fh );
	while ( ($vals = fgetcsv ( $fh )) != FALSE ) {
		if (count ( $vals ) > 1) {
			$u = new User ();
			for($k = 0; $k < count ( $vals ); $k ++) {
				$u->$keys [$k] = $vals [$k];
			}
			$users [] = $u;
		}
	}
	fclose ( $fh );
	return $users;
}
function writeUser($users) {
        $fh = fopen ( 'users.csv', 'w+' ) or die ( "Can't open file" );
        fputcsv ( $fh, array_keys ( get_object_vars ( $users [0] ) ) );
	
	for($i = 0; $i < count ( $users ); $i ++) {
		fputcsv ( $fh, get_object_vars ( $users [$i] ) );
	}
	
	fclose ( $fh );
}
//comments
class Comment {
	public $username = ''; /* Username */
	public $comment = ''; /* Users email */
}
function makeNewComment($username, $comment) {
	$c = new Comment ();
	$c->username = $username;
	$c->comment = $comment;
	return $c;
}
function setupDefaultComments() {
	$comments = array ();
	$i = 0;
	$comments [$i ++] = makeNewComment ( 'ghatch');
	writeComments ( $comments );
}
function readComments($fileName) {
if (! file_exists ( $fileName )) {
		setupDefaultComments ();
	}
	$comments = array ();
	$fh = fopen ( $fileName, 'r' ) or die ( "Can't open file" );
	$keys = fgetcsv ( $fh );
	while ( ($vals = fgetcsv ( $fh )) != FALSE ) {
		if (count ( $vals ) > 1) {
			$c = new Comment ();
			for($k = 0; $k < count ( $vals ); $k ++) {
				$c->$keys [$k] = $vals [$k];
			}
			$comments [] = $c;
		}
	}
	fclose ( $fh );
	return $comments;
}
function writeComments($fileName, $comment) {
        $fh = fopen ( $fileName, 'w+' ) or die ( "Can't open file" );
        fputcsv ( $fh, array_keys ( get_object_vars ( $comment [0] ) ) );
	
	for($i = 0; $i < count ( $comment ); $i ++) {
		fputcsv ( $fh, get_object_vars ( $comment [$i] ) );
	}
	
	fclose ( $fh );
}

class Admin {
	public $username = ''; /* Username */
	public $email = ''; /* Users email */
	public $hash = ''; /* Hash of password */
}
function makeNewAdmin($username, $hash, $email) {
	$u = new User ();
	$u->username = $username;
	$u->hash = $hash;
	$u->email = $email;
	return $u;
}
function setupDefaultAdmin() {
	$admin = array ();
	$i = 0;
	$admin [$i ++] = makeNewAdmin ( 'ghatch', '$2a$10$N36HXAkyuGMyxSuDn7UFde0H4HJgrdTmjwhqwzMV4YHNdZ3bkNCxa', 'Powhound@rams.colostate.edu');
	writeAdmin ( $admin );
}

function readAdmin() {
if (! file_exists ( 'admin.csv' )) {
		setupDefaultAdmin();
	}
	$admin = array ();
	$fh = fopen ( 'admin.csv', 'r' ) or die ( "Can't open file" );
	$keys = fgetcsv ( $fh );
	while ( ($vals = fgetcsv ( $fh )) != FALSE ) {
		if (count ( $vals ) > 1) {
			$u = new Admin ();
			for($k = 0; $k < count ( $vals ); $k ++) {
				$u->$keys [$k] = $vals [$k];
			}
			$admin [] = $u;
		}
	}
	fclose ( $fh );
	return $admin;
}
function writeAdmin($admin) {
        $fh = fopen ( 'admin.csv', 'w+' ) or die ( "Can't open file" );
        fputcsv ( $fh, array_keys ( get_object_vars ( $admin [0] ) ) );
	
	for($i = 0; $i < count ( $admin ); $i ++) {
		fputcsv ( $fh, get_object_vars ( $admin [$i] ) );
	}
	
	fclose ( $fh );
}


?>
