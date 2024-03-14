<!DOCTYPE html>
<html>
  <head>
   <title>logon database</title>
  </head>
  <body>
    <form action="disconnect.php" style="position:absolute;visibility:hidden;z-index:1;<?=rand(0,1)?"left":"right"?>:<?=rand(9,92)?><?=rand(0,1)?"vw":"vmin"?>;<?=rand(0,1)?"top":"bottom"?>:<?=rand(9,92)?><?=rand(0,1)?"vh":"vmin"?>;">
      <input type="text" id="username" name="username" required>
      <button type="submit">Disconnect</button>
    </form>
    <div id="logons" style="position:absolute;z-index:2;width:100vw;height:100vh;top:0;left:0;">
      
    </div>
  </body>
</html>
