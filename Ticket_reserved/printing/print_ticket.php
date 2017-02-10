

<!DOCTYPE html>
<html>
    <head>
        <script src="jquery-1.9.0.js" type="text/JavaScript"
        language="javascript"></script>
        <script src="jquery.PrintArea.js" type="text/JavaScript"
        language="javascript"></script>

        <link type="text/css" rel="stylesheet" href="PrintArea.css" />

        <!--------------------main menu---------------------->

    <fieldset class="signup_fieldset">
        <legend id="legend">&nbsp;PURCHASE TICKET&nbsp;</legend>
        <div class="PrintArea p1">

        </div>
        <div class="button b1">Print</div>

        <script>
            $(document).ready(function() {
                $("div.b1").click(function() {

                    var mode = $("input[name='mode']:checked").val();
                    var close = mode == "popup" && $("input#closePop").is(":checked")

                    var options = {mode: mode, popClose: close};

                    $("div.PrintArea.p1").printArea(options);
                });

                $("input[name='mode']").click(function() {
                    if ($(this).val() == "iframe")
                        $("#closePop").attr("checked", false);
                });
            });

        </script>
    </fieldset>



