<?php
    $dcs = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["DCS_PORT"];
    $door43_preview = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["DOOR43_PREVIEW_PORT"];
    $door43_filebrowser = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["DOOR43_FILEBROWSER_PORT"];
    $cdn_filebrowser = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["CDN_FILEBROWSER_PORT"];
    $tx_filebrowser = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["DOOR43_FILEBROWSER_PORT"];
    $tx_enqueue = "http://" . $_ENV["LISTEN_IP"] . ":" . $_ENV["TX_ENQUEUE_JOB_PROXY_PORT"];
?>
<html>
    <head>
        <title>tX Links & Forms</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
<TABLE BORDER=1>
    <TR>
        <TD>DCS:</TD><TD><a href="<?php echo $dcs?>" target="_blank"><?php echo $dcs?></TD>
    </TR>
    <TR>
        <TD>Door43 Preview:</TD><TD><a href="<?php echo $door43_preview?>" target="_blank"><?php echo $door43_preview?></TD>
    </TR>
    <TR>
        <TD>TX Enqueue:</TD><TD><a href="<?php echo $tx_enqueue?>" target="_blank"><?php echo $tx_enqueue?></TD>
    </TR>
    <TR>
        <TD>Door43 Filebrowser:</TD><TD><a href="<?php echo $door43_filebrowser?>" target="_blank"><?php echo $door43_filebrowser?></TD>
    </TR>
    <TR>
        <TD>CDN Filebrowser:</TD><TD><a href="<?php echo $cdn_filebrowser?>" target="_blank"><?php echo $cdn_filebrowser?></TD>
    </TR>
    <TR>
        <TD>TX Filebrowser:</TD><TD><a href="<?php echo $tx_filebrowser?>" target="_blank"><?php echo $tx_filebrowser?></TD>
    </TR>
</TABLE>

<textarea name="body" id="body"></textarea>
<input type="submit" id="submit" />
</body>

<script>
$(document).ready(function() {
    $('#submit').click(function() {
        $.ajax({
            url: "<?php echo $tx_enqueue?>",
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Basic " + btoa("username:password"));
            }, 
            type: 'POST', 
            dataType: 'json', 
            contentType: 'application/json', 
            processData: false,

            data: {
                serial: $('#body').val()
            }, 

            success: function (data) {
                alert(JSON.stringify(data));
            }, 
            error: function(error){ 
                alert("Cannot get data");
                console.log(error);
            } 
        });
    });
});
</script>
</html>
