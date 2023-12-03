<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="style.css" />
	  
    </head>
    
	<body>	
        <header>
            <h1>hello mr.<?php echo $headercontent; 
            ?>
            </h1>
        </header>
        <div>
            <fieldset>
                <legend>modify a client's info</legend>
                <form id="modify a client" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search" name= "search" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
                <div>
                <form id='modify a client' action='site.php' method='post'>
                    <label> client id:</label>
                    <input type='text' name='client_id' />
                    <label> first name: </label>
                    <input type='text' name='first_name' />
                    <label> last name: </label>
                    <input type='text' name='last_name' />
                    <label> street number: </label>
                    <input type='text' name='street_number' />
                    <label> street name: </label>
                    <input type='text' name='street_name' />
                    <label> postal code: </label>
                    <input type='text' name='postal_code' />
                    <label> tel: </label>
                    <input type='text' name='tel' />
                    <label> mail: </label>
                    <input type='text' name='mail' />
                    <label> profession: </label>
                    <input type='text' name='profession' />
                    <label> family situation: </label>
                    <input type='text' name='family_situation' />
                    <input type='submit' value='modify' name= 'modify' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>  
                </div>  

            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>view all of a clients information</legend>
                <form id="view a client" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search" name= "viewEverythinng" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                 

            </fieldset>

   

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 