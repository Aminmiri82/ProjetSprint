<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    td:hover {
      background-color: #e6e6e6;
      cursor: pointer;
    }

    .occupied {
      background-color: #ff9999; 
    }
    .busy{
        background-color: blueviolet;
    }
  </style>
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
                    <input type="submit" value="change overdraft" name= "change_overdraft" />
                </form>
            </fieldset>
        </div>
        <div>
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
        </div>
    <div>
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
        <div id="planner-container"></div>
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
            <input type="time" name="time">
            <input type="submit" value="add rdv" name= "add_rdv" />
        </form>



    </fieldset>
    </div>

    <script>
        $(document).ready(function() {
            $('#dynamicSelectEmployee').load('get_options_employee.php');
            $('#dynamicSelectClient').load('get_options_client.php');

            $('#dynamicSelectEmployeePlanner').load('get_options_employee.php');
            $('#dynamicSelectClientPlanner').load('get_options_client.php');

            $('#dynamicSelectClientRDV').load('get_options_client.php');
            $('#dynamicSelectEmployeeRDV').load('get_options_employee.php');
            $('#dynamicSelectMotiveRDV').load('get_options_motive.php');
            
           
            $('#dynamicSelectClientCancelAccount').load('get_options_client.php');
            $('#dynamicSelectClientCancelAccount').change(function() {
                var client_id = $(this).val();
                if (client_id) {
                    $('#dynamicSelectAccountCancel').load('get_options_account.php?client_id=' + client_id);
                } else {
                    $('#dynamicSelectAccountCancel').html('<option value="">Select an account</option>');
                }
            });

            $('#dynamicSelectClientCancelContract').load('get_options_client.php');
            $('#dynamicSelectClientCancelContract').change(function() {
                var client_id = $(this).val();
                if (client_id) {
                    $('#dynamicSelectContractCancel').load('get_options_contract.php?client_id=' + client_id);
                } else {
                    $('#dynamicSelectContractCancel').html('<option value="">Select a contract</option>');
                }
            });
            console.log("options loaded");
        });
    </script>     
    <script src="plannerCode.js"></script> 

   

    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 