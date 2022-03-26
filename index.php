<?php
/**
 * File: index.php
 * Description:
 * -------------
 *
 * This is an entry file for this Dataface Application.  To use your application
 * simply point your web browser to this file.
 */
require_once dirname(__FILE__).'/vendor/xataface/xataface/public-api.php';
require_once dirname(__FILE__).'/inc/functions.inc.php';
df_init(__FILE__, 'vendor/xataface/xataface')->display();
