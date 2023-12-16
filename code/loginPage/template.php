<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="styles.css"> 
	  
    </head>
    
	<body>	

    <form id='login_form' action="site.php" method="post">
        <label> username : </label>
        <input type="text" name="user_name" />
        <label> password : </label>
        <input type="password" name="password" />
        <input type="submit" value="login" name= "login" /> <input type="reset" value="tout effacer" name= "eff" /> 
    </form>

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 