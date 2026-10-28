<?php
/**
 * 301 Permanent Redirect from old Diwali URL to new general Gifting page
 */
header("HTTP/1.1 301 Moved Permanently");
header("Location: gifting.php");
exit();
