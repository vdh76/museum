<html>
<body>

<br/><br/>
<form  method="post" action="/confirmation-paiement">
Paiement : 
<select name="resultrans">
<option value="P">Accepté</option>
<option value="R">Refusé</option>
</select>
<input type="hidden" name="num_auto" value="123456">
<input type="hidden" name="montant" value="<?php print $_GET['amount']?>">
<input type="hidden" name="num_auto" value="123456">
<br/><br/>
<input type="submit" value="paiement">
</form>


</body>
</html>