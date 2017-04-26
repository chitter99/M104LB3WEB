<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));
$db = GetDB();

if(!$config['setup']['enabled']) die('Setup is disabled!');

$pass = isset($_POST['confirm']) ? $_POST['confirm'] : $_GET['confirm'];
if(isset($pass)) {
    header('Content-Type: application/json');
    if($pass != $config['setup']['passwd']) {
        die(json_encode([
            'status' => 'failed',
            'message' => 'Password is wrong!'
        ]));
    } else {
        try {
            //$db->build();
            $db->seed();
        } catch(Exception $ex) {
            die(json_encode([
                'status' => 'failed',
                'message' => $ex->getMessage()
            ]));
        }
        die(json_encode([
            'status' => 'success'
        ]));
    }
}

?>

<html>
    <head>
        <script src="./../../public_html/js/jquery.min.js"></script>
    </head>
    <body>
        <input type="text" name="confirm" />
        <button type="submit">confirm</button>
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

