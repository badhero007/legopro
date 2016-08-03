<?php
ob_end_clean();
ob_start();//打开缓冲区
?>
<script language="JavaScript">
    function updateProgress(percent){
        document.getElementById('cc').innerHTML = percent;
    }
</script>
<h1 id="cc"></h1>
<?php
for ($i=1; $i<101; $i++)
{
    //php.ini output_buffering默认是4096字符或者更大，即输出内容必须达到4096字符服务器才会flush刷新输出缓冲
    echo str_repeat(' ', 1024*4);
?>

    <script language="JavaScript">
        updateProgress("<?php echo $i; ?>%");
    </script>

<?php
    ob_flush();
    flush();
    usleep(50000);
}
ob_end_flush();
?>



