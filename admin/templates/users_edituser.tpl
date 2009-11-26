{include file="header.tpl" title=Usermanagement}
{include file="menu.tpl"}
{include file="messagebox.tpl"}
<form action="user.php?action=mkedit" method="post">
<table>
    <tr>
      <td>Name: </td>
      <td><input TYPE="text" SIZE="40" NAME="name" value="{$name}" /> </td>
    </tr>
    <tr>
      <td>Username: </td>
      <td><input TYPE="text" SIZE="40" NAME="username" readonly value="{$username}" /> </td>
    </tr>
    <tr>
      <td>Password: </td>
      <td><input TYPE="password" SIZE="40" NAME="password" /> </td>
    </tr>
    <tr>
      <td>Password validation: </td>
      <td><input TYPE="password" SIZE="40" NAME="password2" /> </td>
    </tr>
    <tr>
      <td>Realy want to edit the user? </td>
      <td><input type="checkbox" name="sure" /> </td>
    </tr>
    <tr>
    	<td><input type="submit" value="Edit now!" />
    </tr>
  </table>

</form>
{include file="footer.tpl"}