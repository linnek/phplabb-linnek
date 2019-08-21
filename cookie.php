<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
@ob_start();
session_start();

if (isset($_COOKIE['counter']))
    $count = $_COOKIE['counter'];
else
    $count = 0;
$count = $count + 1;
setcookie('counter', $count, time() + 24 * 3600, '/', 'localhost', false);
?>
<html>
    <head>
        <title>Counting with a cookie</title>
    </head>
    <body>
        <FORM action="cookie.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            echo "count is $count";
            ?>
        </FORM>
    </body>
</html>

<!--
1. Cookies can store only “string” datatype.

2. They are stored at client side.

3. Cookie is non-secure since stored in text-format at client side.

4. Cookies may or may not be individual for every client.

5. Size of cookie is limited to 40 and number of cookies to be used is restricted to 20.

6. Cookies can be disabled.

7. Since the value is in string format there is no security.

8. We have persistent and non-persistent cookies. -->