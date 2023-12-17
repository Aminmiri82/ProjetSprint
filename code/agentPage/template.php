<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="styles.css"> 
      <script src="luxon.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    </head>
    
	<body>	



        <header>
            <h1>hello mr.<?php echo $headercontent; 
            ?>
            </h1>
            <form action="site.php" method="post">
                <input type="submit" value="log out" name="logout">
            </form>
        </header>
        
        <div class="fieldset-container">
            <fieldset>
                <legend>modify a client's info</legend>
                <form id="see_a_client" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search" name= "search" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
                <label> current info: </label>
                <?php echo $current_info_M; ?>
                <br>
                <label> new info: </label>
                <br>
                <form id='modify_a_client' action='site.php' method='post'>
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
                    <input type='email' name='mail' />
                    <label> profession: </label>
                    <input type='text' name='profession' />
                    <label> family situation: </label>
                    <input type='text' name='family_situation' />
                    <label> birthday: </label>
                    <input type='date' name='birthday' />
                    <input type='submit' value='modify' name= 'modify' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>  
                

            </fieldset>
        
        
            <fieldset>
                <legend>add a client</legend>
                <form id="add_a_client "action="site.php" method="post">
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
                <input type='email' name='mail' />
                <label> profession: </label>
                <input type='text' name='profession' />
                <label> family situation: </label>
                <input type='text' name='family_situation' />
                <label> birthday: </label>
                <input type='date' name='birthday' />
                <input type='submit' value='add a client' name= 'add_a_client' /> <input type='reset' value='tout effacer' name= 'tout effacer' />
                </form>
            </fieldset>
        </div>
        
        <div class="fieldset-container">
            
            <fieldset>
                <legend>assign an employee to a client</legend>
                <form id="assignForm" method="post" action="site.php">
                    <label for="employee">employee to assign: </label>
                    <select id="dynamicSelectEmployee" name="selectedEmployee">
                        <option>Select an option</option>
                    </select>
                    <label for="client_id">to client: </label>
                    <select  id="dynamicSelectClient" name="selectedClient">
                        <option>Select an option</option>
                    </select>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </fieldset>

            <fieldset>
                <legend>view all of a clients information</legend>
                <form id="view_a_client" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search" name= "viewEverythinng" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
                <label> personal info: </label>
                <?php echo $personal_info_E; ?>
                <br>
                <label> accounts: </label>
                <?php echo $accounts_info_E; ?>
                <br>
                <label> contracts: </label>
                <?php echo $contracts_info_E; ?>
                <br>
                <label> assigned employee: </label>
                <?php echo $assigned_employee_E; ?>

            </fieldset>
        </div>
<div class="fieldset-container">
    <fieldset>
        <legend>Make Deposits or Withdraw</legend>
        
            <form id="accountSelectionForm" action="site.php" method="post">
                <label for="clientIdInput">Client ID:</label>
                <input type="text" id="clientIdInput" name="client_id"/>
                <input type="submit" value="search" name= "search_for_accounts" />
                <p><label> accounts in their possession: </label></p>
                <?php echo $accounts_in_users_possesion; ?>
            </form>
       
            <form id="transactionForm" action="site.php" method="post">
                <label for="dynamicSelectAccountCancel">Account ID:</label>
                <select id="dynamicSelectAccountCancel" name="account_id">
                    <option value="">Select an option</option>
                </select>
                <label for="amountInput">Amount:</label>
                <input type="text" id="amountInput" name="amount" />
                <input type="submit" value="Deposit" name="deposit" />
                <input type="submit" value="Withdraw" name="withdraw" />
            </form>
        
    </fieldset>

            <fieldset>
                <legend>search for a client using their name and birthday</legend>
                <form id="search_for_a_client" action="site.php" method="post">
                     <label for="last_name"> client's last name: </label>
                     <input type="text" name="last_name" />
                     <label for="birthday"> client's birthday: </label>
                     <input type="date" name="birthday" />
                     <input type="submit" value="search" name= "search_name" /> <input type="reset" value="tout effacer" name= "tout effacer" />
                </form>
                <label> client info: </label>
                <?php echo $client_info_BD; ?>
            </fieldset>
        </div>
        <div class="fieldset-container">
            <fieldset>
                <legend>change an accounts overdraft</legend>
                <form id="show_the_accounts" action="site.php" method="post">
                     <label> client's id: </label>
                     <input type="text" name="client_id" />
                     <input type="submit" value="search for accounts" name= "search_for_accounts_for_overdraft" />
                     <p><label> accounts in their possession: </label></p>
                     <?php echo $accounts_in_users_possesion_overdraft; ?>
                </form>
                <form id="change_the_overdraft"action="site.php" method="post">
                    <label for="account_id"> account id :</label>
                    <input type="text" name="account_id" />
                    <label for="overdraft"> overdraft :</label>
                    <input type="text" name="overdraft" />
                    <input type="submit" value="change overdraft" name= "change_overdraft" />
                </form>
            </fieldset>

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
            <input type="submit" value="See planner" id="employee_choice">
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
    <div id="planner-container"></div>

    <script>
        $(document).ready(function() {
            $('#dynamicSelectEmployee').load('get_options_employee_withRole.php');
            $('#dynamicSelectClient').load('get_options_client.php');


            $('#clientIdInput').keyup(function() {
                var client_id = $(this).val();
                if (client_id) {
                    $('#dynamicSelectAccountCancel').load('get_options_account.php?client_id=' + client_id);
                } else {
                    $('#dynamicSelectAccountCancel').html('<option value="">Select an account</option>');
                }
            });


            $('#dynamicSelectEmployeePlanner').load('get_options_employee.php');
            $('#dynamicSelectClientPlanner').load('get_options_client.php');

            $('#dynamicSelectClientRDV').load('get_options_client.php');
            $('#dynamicSelectEmployeeRDV').load('get_options_employee.php');
            $('#dynamicSelectMotiveRDV').load('get_options_motive.php');
            
           
            
            console.log("options loaded");
        });
    </script>     
    <script src="plannerCode.js"></script> 

   

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 