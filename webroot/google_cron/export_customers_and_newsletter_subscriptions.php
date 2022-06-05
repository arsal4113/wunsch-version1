<?php

if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../../bin/cake CustomerRegistrationNewsletterSubscriptionExport');
}
