<?php

class Email_Me {

    function simple_ui($actionSubmit = null, $messageMeID = null) {
        if ($actionSubmit != null && $messageMeID != null) {
            //check if entry exists
            if (check_if_entry_exists('emailMe', 'id', $messageMeID)) {

                //get the email address
                $con = read_database_();

                $query = "SELECT email FROM emailMe WHERE id = '$messageMeID'";
                mysql_select_db("phillly_controls", $con);
                $result = mysql_query($query);

                if (!$result) {
                    return "An error has occured.";
                }

                $email = undefined;

                while ($row = mysql_fetch_array($result)) {
                    $email = $row['email'];
                }

                if ($email == '0') {
                    return "NO EMAIL HAS BEEN SET BY THE ADMINISTRATOR FOR THIS EMAILME BOX.";
                }

                return "
             
        <div id='emailMeBody'>
    <form id='emailMeForm' method='post' action='$actionSubmit'>
            <div id='emailMehead'>
            <table id='headTable' class='emailmeTables'>
            <tr>
            <td class='emailMeLables'>
            Email:
            </td>
            <td class='emailInputs'>
            <input type='email' name='email' id='emailMemailfield' class='emailmeTextInputField'><br />
            </td>
            </tr>
            <tr>
            <td class='emailMeLables'>
            Subject:
            </td>
            <td class='emailInputs'>
            <input type='text' name='subject' id='emailMeSubjectfield' class='emailmeTextInputField'>
            </td>
            </tr>
            </table>
            </div>
            <div id='emailBody'>
            <table id='bodyTable' class='emailmeTables'>
            <tr>
            <td class='emailMeLables'>
            Content:<br />
            </td>
            <td class='emailInputs'>
            <textarea name='content' id='emailMeContentField'></textarea>
            </td>
            </tr>
            </table>
            </div></br>
            <div id='mailFoot'>
            <table class='emailmeTables'>
            <tr>
            <td id='emailMeErrorNotification'></td>
           <td id='emailMeSubmitForm'>
             <input type='hidden' value='$email' name='id'>
             
            <input type='reset' name='content' id='emailMeResetButton' class='emailMeButtonInput'><input type='submit' value='Send' name='send' id='emailMeSendButton' class='emailMeButtonInput'>
            </td>
            </tr>
            </table>
            </div>
            
            </form>
            
            
            
        </div>
       
       ";
            } else {
                $createOne = $this->create_new_entry($messageMeID);
                if (!$createOne) {
                    return 'entry does not exist, emailMe failed to create a one. Error: ' . mysql_error();
                }
                /*
                  else{




                  }
                 */
            }
        } else {
            return "EmailMe Message: You must declare an action URL and a messageID for this feature to work.<br />
            <table>
            <tr>
            <td><h3>Argument</h3></td>
            <td><h3>Discription</h3></td>
            </tr>
            <tr>
            <td>\$actionSubmit</td>
            <td>Declare the URL you are planning on submiting this form, whethere it be the self URL or external URL.</td>
            </tr>
            <tr>
            <td>\$messageMeID</td>
            <td>Provide a unique number that that may be used by PHP to uniquely identify this particular emailMe form. This id has been
            genorated by this form, it is recommended that you use this: <input type='text' value='" . uniqid() . "'>
            </td>
            </tr>
            </table>
            ";
        }
    }

    function process_message_ui() {
        //check if proper variables have been set
        if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['content']) && isset($_POST['emailDestination']) && isset($_POST['id'])) {
            return "Good.";
        } else {
            return "No Good";
        }
    }

    function self_simple_ui($actionSubmit = null, $messageMeID = null) {

        if (isset($_POST['send'])) {

            $to = $_POST["id"];
            $subject = "Sent from website: " . $_POST["subject"];
            $message = $_POST['content'];
            $from = $_POST["email"];
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);

            return 'Thank you, your message has been sent.<br />
            From:' . $_POST["email"] . '<br />
            To: ' . $_POST['id'] . '<br />
            Subject:' . $_POST["subject"] . '<br />
            Content: <br />
            ' . $_POST['content'];
        } else {
            return $this->simple_ui($actionSubmit, $messageMeID);
        }
    }

    function create_new_entry($id) {
        $con = write_database_();
        if (!$con) {
            return false;
        } else {
            //continue;
            //succesfully connected to database.

            mysql_select_db("phillly_controls", $con); //selecte database
            if (!mysql_query("INSERT INTO emailMe (id, email)
VALUES ('" . mysql_real_escape_string($id) . "', '0')")) {
                return false;
            } else {
                return true;
            }
        }
    }

    function update_box_email() {
        if (isset($_GET['send'])) {
            $con = write_database_();
            mysql_select_db("phillly_controls", $con);
            $action = mysql_query("UPDATE emailMe SET email='" . mysql_real_escape_string($_GET['email']) . "'
WHERE id='" . mysql_real_escape_string($_GET['inputID']) . "'");

            if (!$action) {
                return "An error has occured: " . mysql_error();
            } else {
                //do something if it's set
                return "new Email: " . $_GET['email'] . "<br />
                    Changes will reflect next time page is loaded.<br />
                    You may now close this window.<br />
                    <input type='button' value='close' onclick='window.close()'>";
            }
        } else {
            //do something if it isn't
            return '<form action="" method="get">
                <input type="hidden" value="' . $_GET['addOnid'] . '" name="inputID">
                <input type="email" name="email" placeholder="phill@philllware.com">
                <input type="button" value="cancel" onclick="window.close()"><input type="submit" name="send">
            </form>';
        }
    }

}

?>
