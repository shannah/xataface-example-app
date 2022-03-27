<?php
/**
 * An action that displays the dashboard - which is the default action of the
 * default table.
 */
class actions_dashboard {
    function handle($params) {
        df_display([], 'app/dashboard.html');
    }
}