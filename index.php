<!DOCTYPE html>
<html>
  <head>
   <title>logon database</title>
  </head>
  <body>
    <form action="disconnect.php" style="position:absolute;visibility:hidden;z-index:1;<?=rand(0,1)?"left":"right"?>:<?=rand(9,92)?><?=rand(0,1)?"vw":"vmin"?>;<?=rand(0,1)?"top":"bottom"?>:<?=rand(9,92)?><?=rand(0,1)?"vh":"vmin"?>;">
      <input type="text" id="username" name="username" required>
      <button id="disconnect" type="submit">Disconnect</button>
    </form>
    <div id="logons" style="position:absolute;z-index:2;width:100vw;height:100vh;top:0;left:0;">
      <div id="actions">
        <button onclick="document.querySelector('#disconnect').click();">Disconnect</button>
      </div>
      <div id="data">
        <table>
          <?php
            $conn = new mysqli('localhost','riley_remote','nathaniel','con_db'); 
            /* Get Database Entries */ # Make sure to remove database entries that get got by commands
            $result=$conn->query("SELECT * FROM users");
            $dbget=$result->fetch_all(MYSQLI_NUM);
            
            /* Current `who -u` */
            exec("who",$who);
            $activeUsers=array();
            foreach($who as $line) {
            	preg_match('/^(\S+)\s+(.+?)\s+([\d-]+)\s+(\S+)\s+(.*)$/',$line,$matches); # match[NAME: user, LINE: Terminal, DATE, TIME, COMMENT: (IP)]
            	# Print out <tr> of result
            	echo "<tr>"."<td><input type='radio' name='sel_user' value='".$matches[0]."' onclick='document.querySelector(\"#username\").value=this.value;'></td>"."<td>".$matches[1]."</td>"."<td>".$matches[2]."@".$matches[3]."</td>"."<td>".$matches[4]."</td>"."</tr>";
            	$activeUsers[]=$matches[0].$matches[1].$matches[2].$matches[3].$matches[4];
            	$conn->query("INSERT INTO users (NAME, LINE, DATE, TIME, COMMENT) VALUES ('".$matches[0]."','".$matches[1]."','".$matches[2]."','".$matches[3]."','".$matches[4].")");
            }
            
            
            foreach ($dbget as $sqlSet) { # Check if database entry matches start time and user. if true remove from MySQL result 
            	foreach($activeUsers as $user) {
            		if ($user==$sqlSet[0].$sqlSet[1].$sqlSet[2].$sqlSet[3].$sqlSet[4]) {
            			goto a;
            		}
            		
            	}
            	# Put Database Print here
            	
            	echo "<tr>"."<td><input type='radio' name='sel_user' value='".$sqlSet[0]."' disabled></td><td>".$sqlSet[1]."</td><td>".$sqlSet[2]."@".$sqlSet[3]."</td><td>".$sqlSet[4]."</td></tr>";
            	
            	a:
            }
            
            
            
            $conn->close();
          ?>
          
        </table>
      </div>
    </div>
  </body>
</html>
