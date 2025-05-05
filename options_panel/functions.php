<?php
function clab_options(){
    $options = get_option('clab-options', []);
    return $options;
}
?>