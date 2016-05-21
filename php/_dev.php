<?php

function degreelessness_mode_dev() {

    // this function only provides the variables
    // it assumes degrelessness_mode![_dev] will run

    if (current_user_can('update_core')) :

        echo '<script type="text/javascript">';
        echo    'var devhosts = {';
        echo       '\'local\': \'jng.dev.local\',';
        echo       '\'dev\': \'jng.dev.bespokemedia.net\',';
        echo       '\'live\': \'jng.me.uk\'';
        echo    '};';
        echo '</script>';

    endif;
}
