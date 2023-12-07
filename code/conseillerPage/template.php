<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	  
    </head>
    
	<body>	



        <header>
            <h1>hello mr.<?php echo $headercontent; 
            ?>
            </h1>
        </header>
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
                <legend>change an accounts overdraft</legend>
                <form id="show the accounts" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search for accounts" name= "search_for_accounts_for_overdraft" />
                     <p><label> accounts in their possession: </label></p>
                     <?php echo $accounts_in_users_possesion_overdraft; ?>
                </form>
                <form id="change the overdraft"action="site.php" method="post">
                    <label for="account_id"> account id :</label>
                    <input type="text" name="account_id" />
                    <label for="overdraft"> overdraft :</label>
                    <input type="text" name="overdraft" />
                    <input type="submit" value="change overdraft" name= "change_overdraft" /><input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>
        </div>   
        <div>
            <fieldset>
                <legend>sell a new contract</legend>
                <form id="sell a new contract"action="site.php" method="post">
                    <label for="client_id">for client:</label>
                    <select  id="dynamicSelectClient" name="selectedClient">
                        <option>Select an option</option>
                    </select>
                    <label for="contrattype_id">type of contract:</label>
                    <select  id="dynamicSelectContratType" name="selectedContratType">
                        <option>Select an option</option>
                    </select>
                    <label for="price">price: </label>
                    <input type="text" name="price" />
                    <label for="opening_date">opening date:</label>
                    <input type="date" name="opening_date" />
                    <input type="submit" value="sell a new contract" name= "sell_a_new_contract" /><input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>
        </div> 
    <script>
        $(document).ready(function() {
            $('#dynamicSelectClient').load('get_options_client.php');
            $('#dynamicSelectContratType').load('get_options_contrattype.php');
            
            console.log("options loaded");
        });
    </script>     

   

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 