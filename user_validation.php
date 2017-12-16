<?php
  $username= $password=$email = "";

  if(isset($_POST['username']))
  {
    $username = sanitizeString($_POST['username']);
  }
  if(isset($_POST['password']))
  {
    $password = sanitizeString($_POST['password']);
  }


  if(isset($_POST['email']))
  {
    $email = sanitizeString($_POST['email']);
  }

  //function to sanitize the input received from the input forms for increasing securtiy.
    function sanitizeString($var) {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
    };

   function validate_password($field) {
   if ($field == "") return "No Password was entered<br>";
   else if (strlen($field) < 6)
   return "Passwords must be at least 6 characters<br>";
   else if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
       return "Passwords require 1 each of a-z, A-Z and 0-9<br>"; return "";
     };


   function validate_email($field) {
     if ($field == "") return "No Email was entered<br>";
      else if (!((strpos($field, ".") > 0) &&
                 (strpos($field, "@") > 0)) ||
                 preg_match("/[^a-zA-Z0-9.@_-]/", $field))
                 return "The Email address is invalid<br>";
               return "";
             };
     function validate_username($field) {
             if ($field == "") return "No Username was entered<br>";
             else if (strlen($field) < 5) return "Usernames must be at least 5 characters<br>";
              else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
                   return "Only letters, numbers, - and _ in usernames<br>";
                   return "";
             }
             $fail = validate_username($username);
             $fail .= validate_password($password);
             $fail .= validate_email($email);

             echo "<!DOCTYPE html>\n<html><head><title>An Example Form</title>";

             if ($fail == "")
             { echo "</head><body>Form data successfully validated:$username, $password,$email.</body></html>";
             // This is where you would enter the posted fields into a database, // preferably using hash encryption for the password.
             exit;
             }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Client validation</title>
    <script>

    function javascriptValidate(form) {
    usererror = validateUsername(form.username.value)
    passworderror= validatePassword(form.password.value)
    emailerror= validateEmail(form.email.value)
    if (usererror == "" && passworderror== "" && emailerror =="") return true
    else {
      alert(usererror+ '\n'+passworderror +'\n'+emailerror ); return false
       }
   };

   function validateUsername(field) {
   if (field == "") return "No Username was entered.\n"
   else if (field.length < 5) return "Usernames must be at least 5 characters.\n"
    else if (/[^a-zA-Z0-9_-]/.test(field))
      return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
      return ""
   };

   function validatePassword(field) {
	if (field == "") return "No Password was entered.\n"
	else if (field.length < 6)
		return "Passwords must be at least 6 characters.\n"
	else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||!/[0-9]/.test(field))
		return "Passwords require one each of a-z, A-Z and 0-9.\n"
	return ""
}

function validateEmail(field) {
	if (field == "") return "No Email was entered.\n"
	else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
		return "The Email address is invalid.\n"
	return ""
}
    </script>
  </head>
  <body>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Signup Form</th>
      <tr><td colspan="2">
      Sorry, the following errors were found<br>
      in your form: <p><font color=red size=1><i><?php echo $fail ?> </i></font></p>
      </td></tr>
      <form method="post" action="user_validation.php" onSubmit="return javascriptValidate(this)">
        <tr>
        <td>Username</td>
        <td><input type="text" maxlength="16" name="username" value="<?php echo $username?>"></td>
        </tr>

         <tr>
         <td>Email</td>
         <td><input type="text" maxlength="64" name="email" value="<?php echo $email?>"> </td>
         </tr>

        <tr>
        <td>Password</td>
        <td><input type="text" maxlength="12" name="password" value="<?php echo $password?>" > </td>
        </tr>

        <tr>
        <td colspan="2" align="center"><input type="submit" value="Signup"></td>
        </tr>

         </form>
         </table>
    </table>
  </body>
</html>
