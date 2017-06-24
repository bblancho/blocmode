<?php

/** Init Admin */

// Add additional add button on widget
defined('SUKAWATI_WIDGET_NAME')      or define('SUKAWATI_WIDGET_NAME', 'jeg-widget-list');
defined('SUKAWATI_SIDEBAR_WIDGET')   or define('SUKAWATI_SIDEBAR_WIDGET', 'Sidebar Widget');
defined('SUKAWATI_FOOTER_WIDGET_1')  or define('SUKAWATI_FOOTER_WIDGET_1', 'Footer Widget 1');
defined('SUKAWATI_FOOTER_WIDGET_2')  or define('SUKAWATI_FOOTER_WIDGET_2', 'Footer Widget 2');
defined('SUKAWATI_FOOTER_WIDGET_3')  or define('SUKAWATI_FOOTER_WIDGET_3', 'Footer Widget 3');
defined('SUKAWATI_SHOP_WIDGET')      or define('SUKAWATI_SHOP_WIDGET', 'Shop Page Widget');
defined('SUKAWATI_FOOTER_INSTAGRAM') or define('SUKAWATI_FOOTER_INSTAGRAM', 'Footer Instagram');
defined('SUKAWATI_FOOTER_SUBSCRIBE') or define('SUKAWATI_FOOTER_SUBSCRIBE', 'Footer Subscribe Form');

if( defined('JEG_PLUGIN_VERSION') ) {
    locate_template(array('admin/import/new-import.php'), true, true);
    locate_template(array('admin/admin-functions.php'), true, true); // Theme Option
    locate_template(array('admin/init-dashboard.php'), true, true);  // Theme Option
    locate_template(array('admin/init-widget.php'), true, true);     // Theme Option
    locate_template(array('admin/init-metabox.php'), true, true);    // Metabox
}