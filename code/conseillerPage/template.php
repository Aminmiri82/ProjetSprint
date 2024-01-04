<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="styles.css"> 
      <script src="luxon.js"></script>
      <script src="jquery-3.7.1.min.js"></script>

    </head>
    
	<body>	



    <header>
    <h1>hello there <?php echo $headercontent; 
        ?>
    </h1>
    <form action="site.php" method="post">
        <input type="submit" value="LOG OUT" name="logout" class="logout-button">
    </form>
    </header>
        <div class="fieldset-container">
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
                <input type='date' name='birthday' />
                <input type='submit' value='add a client' name= 'add_a_client' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>

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
        <div class="fieldset-container">
            <fieldset>
                <legend>sell a new contract</legend>
                <form id="sell a new contract"action="site.php" method="post">
                    <label for="client_id">for client:</label>
                    <select  id="dynamicSelectClientForContrat" name="selectedClientForContrat">
                        <option>Select an option</option>
                    </select>
                    <label for="contrattype_id">type of contract:</label>
                    <select  id="dynamicSelectContratType" name="selectedContratType">
                        <option>Select an option</option>
                    </select>
                    <label for="price">price: </label>
                    <input type="text" name="price" />
                    <label for="opening_date">opening date:</label>
                    <input type="date" name="opening_date_contrat" />
                    <input type="submit" value="sell a new contract" name= "sell_a_new_contract" /><input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>

            <fieldset>
                <legend>open a new account</legend>
                <form id="open a new account"action="site.php" method="post">
                    <label for="client_id">for client:</label>
                    <select  id="dynamicSelectClientForAccount" name="selectedClientForAccount">
                        <option>Select an option</option>
                    </select>
                    <label for="account_type">type of account:</label>
                    <select  id="dynamicSelectAccountType" name="selectedAccountType">
                        <option>Select an option</option>
                    </select>
                    <label for="overdraft">overdraft: </label>
                    <input type="text" name="overdraft" />
                    <label for="opening_date">opening date:</label>
                    <input type="date" name="opening_date_account" />
                    <input type="submit" value="open a new account" name= "open_a_new_account" /><input type='reset' value='tout effacer' name= 'tout effacer' />

                </form>
            </fieldset>

        </div>
        <div class="fieldset-container">
            <fieldset>
                <legend>cancel an contract or account</legend>
                <form id="cancel_account"action="site.php" method="post">
                    <label for="dynamicSelectClientCancelAccount">client_id:</label>
                    <select id="dynamicSelectClientCancelAccount" name="client_id">
                        <option value="">Select an option</option>
                    </select>
                    <label for="dynamicSelectAccountCancel"> account id :</label>
                    <select id="dynamicSelectAccountCancel" name="compte_id">
                        <option value="">Select an option</option>
                    </select>
                    <input type="submit" value="cancel account" name= "cancel_account" />
                </form>
                <form id="cancel_contract" action="site.php" method="post">
                    <label for="dynamicSelectClientCancelContract">client_id:</label>
                    <select id="dynamicSelectClientCancelContract" name="client_id">
                        <option value="">Select an option</option>
                    </select>
                    <label for="dynamicSelectContractCancel">contract id:</label>
                    <select id="dynamicSelectContractCancel" name="contract_id">
                        <option value="">Select an option</option>
                    </select>
                    <input type="submit" value="cancel contract" name= "cancel_contract" />

                </form>
            </fieldset>
    <fieldset>
    <fieldset>
        <legend>planner</legend>
        <form id="get_assigned_employee"action="site.php" method="post">
            <label for="client_id">choose clinet:</label>
            <select id="dynamicSelectClientPlanner" name="client_id">
                <option value="">Select an option</option>
            </select>
            <input type="submit" value="get assigned employee" name= "get_assigned_employee" />
            <label for="assigned_employee">assigned employee is :</label>
            <?php echo $employee_assigned_to_client; ?>
        </form>
        <form id="plannerForm" action="rdvTest.php" method="get">
            <label for="employee">Employee's planner: </label>
            <select id="dynamicSelectEmployeePlanner" name="employee_id">
                <option value="">Select an option</option>
            </select>
            <input type="submit" value="See planner" >
        </form>
        
        <form id="add_rdv" action="site.php" method="post">
            <label for="client_id">choose clinet:</label>
            <select id="dynamicSelectClientRDV" name="client_id">
                <option value="">Select an option</option>
            </select>
            <label for="employee_id">choose employee:</label>
            <select id="dynamicSelectEmployeeRDV" name="employee_id">
                <option value="">Select an option</option>
            </select>
            <label for="motive_id">chosee motive:</label>
            <select id="dynamicSelectMotiveRDV" name="motive_id">
                <option value="">Select an option</option>
            </select>
            <label for="date">choose date:</label>
            <input type="date" name="date">
            <label for="time">choose time:</label>
            <input type="time" name="time" min="09:00" max="18:00" step="3600">
            <input type="submit" value="add rdv" name= "add_rdv" />
        </form>
        <label> requierd documents: </label>
        <?php echo $requierd_documents_rdv; ?>

    </fieldset>
    </div>
    
    <div>
        <fieldset>
            <legend>block time for work</legend>
            <form id="block_time" action="site.php" method="post">
                <label for="employee_id">choose employee:</label>
                <select id="dynamicSelectEmployeeBlock" name="employee_id">
                    <option value="">Select an option</option>
                </select>
                <label for="date">choose date:</label>
                <input type="date" name="date">
                <label for="time">choose time slot:</label>
                <input type="time" name="time_slot">
                <label for="reason">reason for blocking this time slot:</label>
                <input type="text" name="reason">
                <input type="submit" value="block time" name= "block_time" />
        </fieldset>
    </div>
    <div id="planner-container"></div>
    <script>
        $(document).ready(function() {
            $('#dynamicSelectClientForContrat').load('Load_Options/get_options_client.php');
            $('#dynamicSelectContratType').load('Load_Options/get_options_contrattype.php');
            $('#dynamicSelectClientForAccount').load('Load_Options/get_options_client.php');
            $('#dynamicSelectAccountType').load('Load_Options/get_options_comptetype.php');
            
            $('#dynamicSelectClientCancelAccount').load('Load_Options/get_options_client.php');
            $('#dynamicSelectClientCancelAccount').change(function() {
                var client_id = $(this).val();
                if (client_id) {
                    $('#dynamicSelectAccountCancel').load('Load_Options/get_options_account.php?client_id=' + client_id);
                } else {
                    $('#dynamicSelectAccountCancel').html('<option value="">Select an account</option>');
                }
            });

            $('#dynamicSelectClientCancelContract').load('Load_Options/get_options_client.php');
            $('#dynamicSelectClientCancelContract').change(function() {
                var client_id = $(this).val();
                if (client_id) {
                    $('#dynamicSelectContractCancel').load('Load_Options/get_options_contract.php?client_id=' + client_id);
                } else {
                    $('#dynamicSelectContractCancel').html('<option value="">Select a contract</option>');
                }
            });

            $('#dynamicSelectEmployeePlanner').load('Load_Options/get_options_employee_withRole.php');
            $('#dynamicSelectClientPlanner').load('Load_Options/get_options_client.php');

            $('#dynamicSelectClientRDV').load('Load_Options/get_options_client.php');
            $('#dynamicSelectEmployeeRDV').load('Load_Options/get_options_employee_withRole.php');
            $('#dynamicSelectMotiveRDV').load('Load_Options/get_options_motive.php');

            $('#dynamicSelectEmployeeBlock').load('Load_Options/get_options_employee_withRole.php');

            console.log("options loaded");
        });
    </script>  
    <script src="plannerCode.js"></script>
    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 