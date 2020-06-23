<?php if ($row['order_status'] == false) {
    echo "<p class=\"text-success\">New order</p>";
}
else {
    echo "<p class=\"text-warning text-wrap\">Send to delivery service</p>";
} ?>
