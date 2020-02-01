<?php
/**
 * This file contains all constants used within Phantom
 * 
 * @since 2.0.0
 * 
 * @package Phantom.Core
 */

// ========= TYPE CONTANTS =========
define("TYPE_STRING", 1);
define("TYPE_ARRAY", 2);
define("TYPE_INT", 3);
define("TYPE_FUNCTION", 4);

// ========= METHOD CONTANTS =========
define("GET", 1);
define("POST", 2);
define("PUT", 3);
define("DELETE", 4);

// ========= DATABASE CONSTANTS =========
define("PUBLISHED", 'published');
define("AWAITING_REVIEW", 'awaiting_preview');
define("PRIVATE_RECORD", 'private');
define("DRAFT", 'draft');