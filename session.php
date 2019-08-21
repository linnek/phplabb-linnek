<?php
@ob_start();
session_start();

?>
<html>
    <head>
        <title>Counting with the SESSION array</title>
    </head>
    <body>
        <FORM action="session.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            session_start();
            if (!isset($_SESSION['counter']))
                $count = 0;
            else
                $count = $_SESSION['counter'];
            $count = $count + 1;
            $_SESSION['counter'] = $count;
            echo "count is $count";
            ?>
        </FORM>

    </body>
</html>

<!--
1. Session can store any type of data because the value is of data type of “object”

2. These are stored at server side.

3. Sessions are secured because it is stored in binary format/encrypted form and gets decrypted at server.

4. Session is independent for every client i.e. individual for every client.

5. There is no limitation on the size or number of sessions to be used in an application.

6. We cannot disable the sessions. Sessions can be used without cookies also.

7. The disadvantage of session is that it is a burden or an overhead on server.

8. Sessions are called as Non-Persistent cookies because its life time can be set manually -->