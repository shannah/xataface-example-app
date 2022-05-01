<?php
/**
 * An action that displays the dashboard - which is the default action of the
 * default table.
 */
class actions_dashboard {
    function handle($params) {
        $app = Dataface_Application::getInstance();
        $app->prefs['show_table_tabs'] = false;
        $app->prefs['show_bread_crumbs'] = false;
        $app->prefs['show_search'] = false;
        df_display([], 'app/dashboard.html');
    }
}