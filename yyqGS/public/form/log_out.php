<?php

/**
 * Destroy the session, and log out.
 */

require_once '../../private/initialize.php';
unset($_SESSION['ID']);
unset($_SESSION['loggedIn']);
session_destroy();
redirect_to(url_for('index.php'));