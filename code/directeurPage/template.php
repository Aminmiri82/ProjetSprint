<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="style.css" />
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    
	<body>	
        <div>
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
        </div>
        <div>
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


   
    <script>  
        $(document).ready(function(){
            $('#dynamicSelectEmployeeLogin').load('get_options_employee.php');
            $('#dynamicSelectAccountTypeModify').load('get_options_comptetype.php');
        });
    </script>
    <?php
        echo $contenu;  
    ?>

  </body>


 </html>
 