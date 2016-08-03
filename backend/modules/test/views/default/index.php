<?php
    //防止执行超时
    set_time_limit(0);
    //清空并关闭输出缓存
    ob_end_clean();
    //需要循环的数据
    for($i = 0; $i < 188; $i++)
    {
        $users[] = 'Tom_' . $i;
    }
    //计算数据的长度
    $total = count($users);
    //显示的进度条长度，单位 px
    $width = 500;
    //每条记录的操作所占的进度条单位长度
    $pix = $width / $total;
    //默认开始的进度条百分比
    $progress = 0;
?>

    <style>
        body,div input {
            font-size: 9pt
        }
    </style>
    <script language="JavaScript">
        function updateProgress(sMsg, iWidth)
        {
            document.getElementById("status").innerHTML = sMsg;
            document.getElementById("progress").style.width = iWidth + "px";
            document.getElementById("percent").innerHTML = parseInt(iWidth / <?php echo $width; ?> * 100) + "%";
        }
    </script>

<div style="margin:50px auto; padding: 8px; border: 1px solid gray; background: #EAEAEA; width: <?php echo $width+8; ?>px">
    <div style="padding: 0; background-color: white; border: 1px solid navy; width: <?php echo $width; ?>px">
        <div id="progress" style="padding: 0; background-color: #FFCC66; border: 0; width: 0px; text-align: center; height: 16px">
        </div>
    </div>
    <div id="status" style="margin-top: 20px"></div>
    <div id="percent" style="position: relative; top: -30px; text-align: center; font-weight: bold; font-size: 8pt">0%</div>
</div>
<?php
flush();
ob_flush();
?>
<?php
    foreach($users as $user)
    {
        // 如果你的操作不耗时，我想你就没必要使用这个脚本了 :)
        echo str_repeat(' ', 1024*4);
        usleep(50000);//模拟耗时操作
?>
        <script language="JavaScript">
            updateProgress("user <?php echo $user; ?> ....", <?php echo min($width, intval($progress)); ?>);
        </script>
<?php
        ob_flush();
        flush(); //将输出发送给客户端浏览器，使其可以立即执行服务器端输出的 JavaScript 程序。
        $progress += $pix;
    }
?>
<script language="JavaScript">
    //最后将进度条设置成最大值 $width，同时显示操作完成
    updateProgress("complete!", <?php echo $width; ?>);
</script>

<?php
flush();
ob_flush();
?>

