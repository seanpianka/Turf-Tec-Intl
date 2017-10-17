<?php

/*
 * The names of valid tables in the database.
 */
const TABLE_NAMES = array("User", "Product", "Image", "Message", "Transactions");
/*
 * Specify the columns of a table that should be ignored when being displayed in the "/portals/tables.php" tables.
 * If the array is empty, all columns from that table should be displayed.
 */
const TABLE_IGNORE_COLUMNS = array(
    TABLE_NAMES[0] => array("password"),
    TABLE_NAMES[1] => array("long_description", "literature"),
    TABLE_NAMES[2] => array(),
    TABLE_NAMES[3] => array("message"),
    TABLE_NAMES[4] => array(),
);
/*
 * The long and short names of the store (made constants so that if changes made for appearance, they're fast/easy).
 */
define("SHOP_NAME", "Turf-Tec International");
define("SHOP_NAME_SHORT", "Turf-Tec");
/*
 * Location of credentials to login to MySQL database.
 * line 1: username
 * line 2: plaintext password
 * line 3: database name
 * The port is assumed to be the default port for MySQL.
 */
define("CREDENTIALS_FILE", $_SERVER['DOCUMENT_ROOT']."/creds.txt");
/*
 * The standard/generic error message when die()'ing.
 */
define("DEFAULT_ERROR_MSG", "Unable to connect to the database. Contact the developers.");
