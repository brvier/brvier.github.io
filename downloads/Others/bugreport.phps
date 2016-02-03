<?php

// Khertan Bug Report Api
// Example : http://khertan.net/flyspray/bugreport.php?project_id=1&item_summary=Test%201&detailed_desc=it%20s%20test&product_version=3.0.15&task_priority=2&task_severity=2&task_type=1&anon_email=khertan@khertan.net&product_category=0
define('IN_FS', true);
require_once(dirname(__FILE__).'/header.php');

require_once BASEDIR . '/includes/class.notify.php';
require_once BASEDIR . '/includes/class.jabber2.php';
$notify = new Notifications;

// Background daemon that does scheduled reminders
if ($conf['general']['reminder_daemon'] == '2') {
    Flyspray::startReminderDaemon();
}

$i=-1;

$user = new User(0, $proj);

if ($user->can_open_task($proj)) {
$args['project_id'] = $_REQUEST['project_id'];
$args['item_summary'] = $_REQUEST['item_summary'];
$args['detailed_desc'] = $_REQUEST['detailed_desc'];
$args['product_version'] = $_REQUEST['product_version'];
$args['product_category'] = $_REQUEST['product_category'];
$args['task_severity'] = $_REQUEST['task_severity'];
$args['task_priority'] = $_REQUEST['task_priority'];
$args['task_type'] = $_REQUEST['task_type'];
$args['anon_email'] = $_REQUEST['anon_email'];

$i = Backend::create_task($args);

echo '200';
}


?>
