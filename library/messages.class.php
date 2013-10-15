<?php

class Messagesssssssssssssssssssss {

//-----------------------------------------------------------------------------------------------
// Class Variables
//-----------------------------------------------------------------------------------------------
var $msgId;
var $msgTypes = array( 'help', 'info', 'warning', 'success', 'error' );
var $msgClass = 'message';
var $msgWrapper = "<div class='%s %s'><a href='#' class='closeMessage'></a>\n%s</div>\n";
var $msgBefore = '<p>';
    var $msgAfter = "</p>\n";


//-----------------------------------------------------------------------------------------------
// __construct()
//-----------------------------------------------------------------------------------------------

public function __construct() {

// Generate a unique ID for this user and session
$this->msgId = md5(uniqid());

// Create the session array if it doesnt already exist
if( !array_key_exists('flash_messages', $_SESSION) ) $_SESSION['flash_messages'] = array();

}

//-----------------------------------------------------------------------------------------------
// add()
// adds a new message to the session data
//-----------------------------------------------------------------------------------------------

public function add($type, $message) {

if( !isset($_SESSION['flash_messages']) ) return false;

if( !isset($type) || !isset($message[0]) ) return false;

// Replace any shorthand codes with their full version
if( strlen(trim($type)) == 1 ) {
$type = str_replace( array('h', 'i', 'w', 'e', 's'), array('help', 'info', 'warning', 'error', 'success'), $type );

// Backwards compatibility...
} elseif( $type == 'information' ) {
$type = 'info';
}

// Make sure it's a valid message type
if( !in_array($type, $this->msgTypes) ) die('"' . strip_tags($type) . '" is not a valid message type!' );

// If the session array doesn't exist, create it
if( !array_key_exists( $type, $_SESSION['flash_messages'] ) ) $_SESSION['flash_messages'][$type] = array();

$_SESSION['flash_messages'][$type][] = $message;

return true;

}

//-----------------------------------------------------------------------------------------------
// display()
// print queued message to the screen
//-----------------------------------------------------------------------------------------------

public function display($type='all', $print=true) {
$messages = '';
$data = '';

if( !isset($_SESSION['flash_messages']) ) return false;

if( $type == 'g' || $type == 'growl' ) {
$this->displayGrowlMessages();
return true;
}

// Print a certain type of message?
if( in_array($type, $this->msgTypes) ) {
foreach( $_SESSION['flash_messages'][$type] as $msg ) {
$messages .= $this->msgBefore . $msg . $this->msgAfter;
}

$data .= sprintf($this->msgWrapper, $this->msgClass, $type, $messages);

// Clear the viewed message
$this->clear($type);

// Print ALL queued message
} elseif( $type == 'all' ) {
foreach( $_SESSION['flash_messages'] as $type => $msgArray ) {
$messages = '';
foreach( $msgArray as $msg ) {
$messages .= $this->msgBefore . $msg . $this->msgAfter;
}
$data .= sprintf($this->msgWrapper, $this->msgClass, $type, $messages);
}

// Clear ALL of the message
$this->clear();

// Invalid Message Type?
} else {
return false;
}

// Print everything to the screen or return the data
if( $print ) {
echo $data;
} else {
return $data;
}
}


//-----------------------------------------------------------------------------------------------
// hasErrors()
// Checks to see if there are any queued error message
//-----------------------------------------------------------------------------------------------

public function clear($type='all') {
if( $type == 'all' ) {
unset($_SESSION['flash_messages']);
} else {
unset($_SESSION['flash_messages'][$type]);
}
return true;
}


//-----------------------------------------------------------------------------------------------
// hasMessages()
// Checks to see if there are queued message of any kind
//-----------------------------------------------------------------------------------------------

public function hasErrors() { return empty($_SESSION['flash_messages']['error']) ? false : true;	}

//-----------------------------------------------------------------------------------------------
// __toString
// "magic" method that will, in this case, return the result from $this->hasMessages()
//-----------------------------------------------------------------------------------------------

public function __toString() { return $this->hasMessages();	}


//-----------------------------------------------------------------------------------------------
// clear()
// deletes all the queued message in the session data
//-----------------------------------------------------------------------------------------------

public function hasMessages($type=null) {
if( !is_null($type) ) {
if( !empty($_SESSION['flash_messages'][$type]) ) return $_SESSION['flash_messages'][$type];
} else {
foreach( $this->msgTypes as $type ) {
if( !empty($_SESSION['flash_messages']) ) return true;
}
}
return false;
}

//-----------------------------------------------------------------------------------------------
// __destruct()
// Purges all of the message from the session data
//-----------------------------------------------------------------------------------------------

public function __destruct() {
//$this->clear();
}


} // end class