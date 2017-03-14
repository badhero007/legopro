<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>JSAPI与URLAPI结合示例</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=E891c39f61cbd82dbb0f48c6e9db8c93"></script>
    <script src="http://d1.lashouimg.com/static/js/release/jquery-1.4.2.min.js" type="text/javascript"></script>
    <style type="text/css">
        html,body{
            width:800px;
            height:600px;
            margin:0;
            overflow:hidden;
        }
    </style>
</head>
<body>
<!--<img src="/icon.png" alt=""/>-->
<div style="width:800px;height:600px;border:1px solid gray" id="container"</div>
</body>
</html>
<script type="text/javascript">

    $(function(){
        $.ajax({
            url:'getplaces',
            dataType:'json',
            success:function(data){
                var map = new BMap.Map("container");
                map.centerAndZoom('北京', 13);
                map.enableScrollWheelZoom();
                $.each(data,function(k,value){
                    var myicon = new BMap.Icon("/icon.png",new BMap.Size(23, 25), {

                    });
                    var marker= new BMap.Marker(new BMap.Point(value.long,value.lat),{icon:myicon});
                    map.addOverlay(marker);
                    var licontent="<b>"+value.name+"</b><br>";
                    licontent+="<span style='color: red'>新增扣分："+value.point+"</span><br>";
                    var content ="<form id=\"gotobaiduform\" action=\"http://api.map.baidu.com/direction\" target=\"_blank\" method=\"get\">" + licontent +"</form>";
                    var opts = { width: 100 };
                    var infoWindow = new BMap.InfoWindow(content, opts);
                    marker.openInfoWindow(infoWindow);
                    marker.addEventListener('click',function(){
                        marker.openInfoWindow(infoWindow);
                    });
                })
            }
        })
    })

</script>

