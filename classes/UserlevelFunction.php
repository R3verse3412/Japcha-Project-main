<?php

// functions.php

// functions.php

function generateDashboard($permission, $label, $url) {
    if ($permission) {
        echo '<li>
                <a href="' . htmlspecialchars($url) . '">
                    <i class="fa fa-home icon"></i>
                    <span class="link_name">' . htmlspecialchars($label) . '</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="' . htmlspecialchars($url) . '">' . htmlspecialchars($label) . '</a></li>
                </ul> 
            </li>';
    }
}
