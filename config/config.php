<?php
# disable time and memory limit
ini_set('memory_limit', -1);
set_time_limit(-1);

# settings
const BASE_PATH = '';
const DEBUG_MODE = false;
const CHAT_LOG = false;
const TOKEN = '';
const NAME = 'Spaghetti';
const DESCRIPTION = 'Pasta Nigger';
const PREFIX = '§';
const DEV = '';

# error reporting
error_reporting(-1);
if ( DEBUG_MODE ) {
	ini_set('display_errors', true);
	log_errors(false);
}
else {
	ini_set('display_errors', false);
	log_errors(true);
}