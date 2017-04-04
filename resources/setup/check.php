<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));
$db = GetDB();

?>

<html>
    <body>
        <select>
            <?php foreach($db->GetAllInvoiceStatus() as $status): ?>
                <option value="<?php echo $status['id']; ?>"><?php echo $status['status']; ?></option>
            <?php endforeach; ?>
        </select>
    </body>
</html>
