<link href="css/style.css" rel="stylesheet" type="text/css"/>
<div id="contact">
    <div id="contact_t_head">Contact:</div>
    <form action="#" method="get" enctype="text/plain" id="contact_body">
        <?php
        $From = isset($_GET['from']) ? $_GET['from'] : "";
        $Messege = isset($_GET['comment']) ? $_GET['comment'] : "";
        $sub = isset($_GET['subject']) ? $_GET['subject'] : "";
        ;
        if (!empty($sub) && !empty($Messege) && !empty($From)) {
            include 'email/Email.php';
            $Email = new Email($sub, $From, $Messege);
            $sen = $Email->sendMail();
            if ($sen) {
                echo "Send from " . $From . "<br/>";
            }
        } elseif (empty($sub) && empty($Messege) && empty($From)) {
            echo " ";
        } else {
            echo "Please Insert correct information<br/>";
        }
        ?>
        <div> Subject:
            <input type="text" name="subject" value="" class="search_tex" placeholder=" Subject"/><br /></div>
        <div> E-mail: <?php echo ' '; ?>
            <input type="email" name="from" value="" class="search_tex" placeholder="  Email"/><br /></div>
        <div> comment:
            <textarea name="comment" id="broser_tex_aera" cols="20" rows="10" maxlength="120"></textarea></div>
        <div> <input type="submit" value="Send Mail" name="sendmail"/>
            <input type="reset" value="Reset"></div>
    </form>
</div>

