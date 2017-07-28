<HTML>
 <HEAD><TITLE> Web Viewer </TITLE></HEAD>
 <body onLoad='onInit()' onUnload='onClose()'>
  <div>
   <OBJECT id='HX_Media' codebase='http://76.177.83.234/NautilusV20_DHInc.cab#Version=2,3,0,5'
    classid='clsid:731D29F4-2872-4542-B85F-539610D7C5DB' standby='Downloading the ActiveX Control...'
    width=512 height=368 align=center hspace=0 vspace=0>
   </OBJECT>
  </div>
</HTML>
<script>
var obj = document.getElementById('HX_Media');
function onInit()
{
  obj.Initialize(1);
  obj.ViewLayout = 0;
  obj.Connect(0, '76.177.83.234/1/stream2', 80, 3, 0, 0);
  obj.SetMenuType(0);
}
function onClose()
{
  obj.Disconnect(0);
}
</script>