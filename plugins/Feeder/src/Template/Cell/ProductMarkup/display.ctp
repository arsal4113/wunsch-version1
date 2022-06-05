<?php
if(isset($productMarkup) && !empty($productMarkup)) {
    echo '<script type="application/ld+json">';
    echo json_encode($productMarkup);
    echo '</script>';
}