<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bishnu
 * Date: 12/4/14
 * Time: 11:49 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html>
<html>
<body>
<style>
    .valid { color: #0d0; }
    .invalid { color: #d00; }
</style>
<div id="output"></div>
<script>
    function check(input) {
        var out = document.getElementById('output');
        if (input.validity) {
            if (input.validity.valid === true) {
                out.innerHTML = "<span class='valid'>" + input.id +
                    " is valid</span>";
            } else {
                out.innerHTML = "<span class='invalid'>" + input.id +
                    " is not valid</span>";
            }
        }
        console.log(input.checkValidity());
    };
</script>
<form id="testform">
    <label>Required:
        <input oninput="check(this)" id="required_input"
               required />
    </label><br>
    <label>Pattern ([0-9][A-Z]{3}):
        <input oninput="check(this)" id="pattern_input"
               pattern="[0-9][A-Z]{3}"/>
    </label><br>
    <label>Min (4):
        <input oninput="check(this)" id="min_input"
               type=number min=4 />
    </label><br>
</form>
</body>
</html>