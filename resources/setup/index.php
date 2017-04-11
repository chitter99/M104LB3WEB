<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));
$db = GetDB();

if(!$config['setup']['enabled']) die('Setup is disabled!');

if(isset($_POST['confirm'])) {
    header('Content-Type: application/json');
    if($_POST['confirm'] != $config['setup']['passwd']) {
        die(json_encode([
            'status' => 'failed',
            'message' => 'password_not_match'
        ]));
    } else {
        die(json_encode([
            'status' => 'success'
        ]));
        $db->build();
        $db->seed();
    }
}

?>

<html>
    <head>
        <script src="./../../public_html/js/jquery.min.js"></script>
    </head>
    <body>
        <input type="text" name="confirm" />
        <button type="sumit">confirm</button>
        <script>
            $(document).ready(function() {
                $('button').click(function() {
                    $.post({
                        url: 'index.php',
                        method: 'POST',
                        data: {
                            confirm: $('input[name=confirm]').val()
                        }
                    }, function(data) {
                        if(data.status != 'success') {
                            alert(data.message);
                        } else {
                            alert('Database seeded successfully!');
                        }
                    });
                });
            });
        </script>
    </body>
</html>

