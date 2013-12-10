
        <script type="text/javascript">
    
            $(document).ready(function(){
        
                $("[ui=date]").datepicker();
                $("#addevent").jqTransform();
                $("[name=name]").focus();
                $("#addevent").validate();
                
                $("#cancelb").click(function(){
                    window.open('<?php echo URL?>', '_self');
                });
        
                //when start date is set, change end date to the same
                 
                $("[name=sDate]").change(function(){
                    $("[name=eDate]").val($(this).val());
                });
            });     
        </script>



            <div class="guinititle">
                <img style="display: inline; box-shadow: none;" src="<?php echo URL?>private/images/calendar_view_month.png" /> Create A New Event
            </div>


            <form id="addevent" class="jqtransform" method="post" action="<?php echo URL ?>edit/setEvent">

                <div class="guiniinner">

                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                        <lable for="name" >Name: </lable>
                        </td>
                        <td>
                            <input type="text" name="title" class="required" />
                        </td>
                        </tr>
                        <tr>
                            <td>
                        <lable for="sdate">Start Date:</lable>
                        </td>
                        <td>
                            <input type="text" ui="date" name="sDate" class="required date" />

                        </td>
                        </tr>
                        <tr>
                            <td>
                        <lable for="stime">Start Time:</lable> 
                        </td>
                        <td>
                            <select name="stime_a" >
<?php
for ($a = 1; $a < 13; $a++) {
    echo "<option value='$a'>$a</option>";
}
?>



                            </select>

                            <select name="stime_b" >
<?php
for ($a = 0; $a < 61; $a++) {
    if ($a < 10) {
        $a = "0" . $a;
    }
    echo "<option value='$a'>$a</option>";
}
?>



                            </select>
                        </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <table><tr><td>
                                            <input type="radio" name="am" checked="checked" value="0">
                                    <lable for="am">AM</lable>
                            </td>
                            <td>
                                <input type="radio" name="am" value="1">
                        <lable for="pm">PM</lable>
                        </td>
                        </tr>
                    </table>
                    </td> 
                    </tr>
                    <tr>

                        <td>
                    <lable for="edate">End Date:</lable>
                    </td>
                    <td>
                        <input type="text" ui="date" name="eDate" class="required date"/>
                    </td>
                    </tr>
                    <tr>
                        <td>
                    <lable for="etime">End Time: </lable>
                    </td>
                    <td>
                        <select name="stime_c" >
<?php
for ($a = 1; $a < 13; $a++) {
    echo "<option value='$a'>$a</option>";
}
?>



                        </select>

                        <select name="stime_d" >
<?php
for ($a = 0; $a < 61; $a++) {
    if ($a < 10) {
        $a = "0" . $a;
    }
    echo "<option value='$a'>$a</option>";
}
?>



                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table><tr><td>
                                        <input type="radio" name="am1" checked="checked" value="0">
                                <lable for="am">AM</lable>
                        </td>
                        <td>
                            <input type="radio" name="am1" value="1">
                    <lable for="pm">PM</lable>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    <tr>
                        <td>
                    <lable for="location">Location: </lable>
                    </td>
                    <td>
                        <input type="text" name="location" class="required">
                    </td>
                    </tr>
                    <tr>
                        <td>
                    <lable for="disc">Event Description: </lable>
                    </td>
                    <td>
                        <textarea name="disc" class="required"></textarea>
                    </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" id="cancelb" value="Cancel" /><input type="submit" value="Create New Date" /></td>
                    </tr>

                    </tbody>
                    </table>









