<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="styles.css"> 
      <script src="jquery-3.7.1.min.js"></script>
    </head>

    <header>
    <h1>hello there <?php echo $headercontent; ?></h1>
    <form action="site.php" method="post">
        <input type="submit" value="LOG OUT" name="logout" class="logout-button">
    </form>
    </header>
    
	<body>	
        <div class="fieldset-container">
            <fieldset>
                <legend>chnage or add employees passwords</legend>
                <form id="change_employee_login" action="site.php" method="post">
                    <label for="employee">Employee's name: </label>
                        <select id="dynamicSelectEmployeeLogin" name="employee_id">
                            <option value="">Select an option</option>
                        </select>
                    <label for="new_username">New username: </label>
                        <input type="text" name="new_username" id="new_username" placeholder="New username">
                    <label for="new_password">New password: </label>
                        <input type="password" name="new_password" id="new_password" placeholder="New password">
                    <input type="submit" name="change_employee_login" value="Change or add employee login">
                </form>
            </fieldset>

            <fieldset>
                <legend>add/modify/delete account types</legend>
                <form id="modify account types" action="site.php" method="post">
                    <label for="account_type">Curent account types: </label>
                        <select id="dynamicSelectAccountTypeModify" name="account_type">
                            <option value="">Select an option</option>
                        </select>
                    <br>
                    <label for="action">Action: </label>
                    <label for="add">Add new type</label>
				    <input type="radio" name="action" id="add" value="add">
				    <label for="change">chnage the chosen type</label>
				    <input type="radio" name="action" id="change" value="change">
				    <label for="delete">Delete the chosen type</label>
				    <input type="radio" name="action" id="delete" value="delete">
                    <br>
                    <label for="text_box">text box:</label>
                    <input type="text" name="text_box" id="text_box" placeholder="text box">
                    <input type="submit" name="modify_account_types" value="Modify account types">
                </form>
            </fieldset>
        </div>
        <div class="fieldset-container">
            <fieldset>
                <legend>add/modify/delete contract types</legend>
                <form id="modify contract types" action="site.php" method="post">
                    <label for="contrat_type">Curent contract types: </label>
                        <select id="dynamicSelectContratTypeModify" name="Contrat_type">
                            <option value="">Select an option</option>
                        </select>
                    <br>
                    <label for="actionC">Action: </label>
                    <label for="addC">Add new type</label>
				    <input type="radio" name="actionC" id="addC" value="add">
				    <label for="changeC">chnage the chosen type</label>
				    <input type="radio" name="actionC" id="changeC" value="change">
				    <label for="deleteC">Delete the chosen type</label>
				    <input type="radio" name="actionC" id="deleteC" value="delete">
                    <br>
                    <label for="text_box">text box:</label>
                    <input type="text" name="text_box" id="text_box" placeholder="text box">
                    <input type="submit" name="modify_Contrat_types" value="Modify Contrcat types">
                </form>
            </fieldset>

            <fieldset>
                <legend>add/modify/delete documents</legend>
                <form id="modify_document_list"action="site.php" method="post">
                    <label for="motive">Curent motive list: </label>
                        <select id="dynamicSelectMotive" name="motive_id">
                            <option value="">Select an option</option>
                        </select>
                    <label for="documents_id">Curent document list: </label>
                        <select id="dynamicSelectDocument" name="documents_id">
                            <option value="">Select an option</option>
                        </select>
                    <br>
                    <label for="actionM">Action: </label>
                    <label for="addM">Add new document needed for a rdv</label>
				    <input type="radio" name="actionM" id="addM" value="add">
                    <label for="add2M">Add existing document needed for a rdv</label>
				    <input type="radio" name="actionM" id="add2M" value="add2">
				    <label for="changeM">chnage the chosen document's name</label>
				    <input type="radio" name="actionM" id="changeM" value="change">
				    <label for="deleteM1">Delete the chosen document for this rdv</label>
				    <input type="radio" name="actionM" id="deleteM1" value="delete1">
                    <label for="deleteM2">Delete the chosen document for all rdv's</label>
				    <input type="radio" name="actionM" id="deleteM2" value="delete2">
                    <br>
                    <label for="text_box">text box:</label>
                    <input type="text" name="text_boxM" id="text_boxM" placeholder="text box">
                    <input type="submit" name="modify_documents_list" value="Go!">
                    

                </form>
            </fieldset>
        </div>
        <div class="fieldset-container">
            <fieldset>
                <legend>bank's stats:</legend>
                <form id="Contract_stats"action="site.php" method="post">
                    <label for="signed_contracts">show me the signed contracts between two dates:</label>
                    <br>
                    <label for="start_date">start date: </label>
                    <input type="date" name="start_date" >
                    <label for="end_date">end date: </label>
                    <input type="date" name="end_date" >
                    <input type="submit" name="Contract_stats" value="Go!">
                </form>
                <?php echo $C_stats; ?>
            </fieldset>
            <fieldset>
                <legend>bank's stats:</legend>
                <form id="rdv_stats"action="site.php" method="post">
                    <label for="rdv_stats">show me the rdv's between two dates:</label>
                    <br>
                    <label for="start_date">start date: </label>
                    <input type="date" name="start_date" >
                    <label for="end_date">end date: </label>
                    <input type="date" name="end_date" >
                    <input type="submit" name="rdv_stats" value="Go!">
                </form>
                <?php echo $R_stats; ?>
            </fieldset>
        </div>
        <div class="fieldset-container">
            <fieldset>
                <legend>bank's stats:</legend>
                <form id="client_stats"action="site.php" method="post">
                    <label for="client_stats">show me the number of clients before a date:</label>
                    <br>
                    <label for="end_date">before the date: </label>
                    <input type="date"  class="mr_fucking_annoyington" name="end_date">
                    <input type="submit" name="client_stats" value="Go!">
                </form>
                <?php echo $CL_stats; ?>
            </fieldset>

            <fieldset>
                <legend>bank's stats:</legend>
                <form id="account_stats"action="site.php" method="post">
                    <label for="account_stats">show me the total balance of all accounts in a date:</label>
                    <br>
                    <label for="end_date">before the date: </label> 
                    
                    <input type="date" class="mr_fucking_annoyington" name="end_date">
                    <input type="submit" name="account_stats" value="Go!">
                </form>
                <?php echo $A_stats; ?>
            </fieldset>
        </div>



   
    <script>  
        $(document).ready(function(){
            $('#dynamicSelectEmployeeLogin').load('Load_Options/get_options_employee.php');
            
            $('#dynamicSelectAccountTypeModify').load('Load_Options/get_options_comptetype.php');
            $('#dynamicSelectContratTypeModify').load('Load_Options/get_options_contrattype.php');

            $('#dynamicSelectMotive').load('Load_Options/get_options_motive.php');
            $('#dynamicSelectDocument').load('Load_Options/get_options_document.php');
        
        });
    </script>
    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 