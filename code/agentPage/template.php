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
                    <label> birthday: </label>
                    <input type='text' name='birthday' />
                    <input type='submit' value='modify' name= 'modify' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>  
                </div>  

            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>add a client</legend>
                <form id="add a client "action="site.php" method="post">
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
                <label> birthday: </label>
                <input type='text' name='birthday' />
                <input type='submit' value='add a client' name= 'add_a_client' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>assign an employee to a client</legend>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>view all of a clients information</legend>
                <form id="view a client" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search" name= "viewEverythinng" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>make deposits or withdraw</legend>
                <div>
                <form id="show the accounts" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search for accounts" name= "search_for_accounts" />
                     <p><label> accounts in their possession: </label></p>
                     <?php echo $accounts_in_users_possesion; ?>
                </form>
                </div>
                <div>
                <form id ="make a deposit or withdrawl" action="site.php" method="post">
                    <label for="aacount_id"> account id :</label>
                    <input type="text" name="account_id" />
                    <label for="amount"> amount :</label>
                    <input type="text" name="amount" />
                    <label for="deposit"> deposit :</label>
                    <input type="submit" value="deposit" name= "deposit" />
                    <label for="withdraw"> withdraw :</label>
                    <input type="submit" value="withdraw" name= "withdraw" />
                </form>
                </div>
                
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>search for a client using their name and birthday</legend>
                <form id="search for a client" action="site.php" method="post">
                     <label for="last_name"> client's last name: </label>
                     <input type="text" name="last_name" />
                     <label for="birthday"> client's birthday: </label>
                     <input type="text" name="birthday" />
                     <input type="submit" value="search" name= "search_name" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
            </fieldset>
        </div>

       

   

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 