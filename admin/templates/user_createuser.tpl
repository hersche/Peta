{include file="header.tpl" title=Usermanagement} {include file="menu.tpl"} {include file="messagebox.tpl"}
<form action="user.php?action=mkuser" method="post">
    <table>
        <tr>
            <td>Name:</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="name" />
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="username" />
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input TYPE="password" SIZE="40" NAME="password" />
            </td>
        </tr>
        <tr>
            <td>Password validation:</td>
            <td>
                <input TYPE="password" SIZE="40" NAME="password2" />
            </td>
        </tr>
        <tr>
            <td>Userrole:</td>
            <td>
                <select name="role" size="1">
                    {section name=role loop=$roles}
                    <option>{$roles[role]}</option>
                    {/section}
                </select>

        </tr>
        <tr>
            <td>
                <input type="submit" value="Create now!" />

        </tr>
    </table>

</form>
{include file="footer.tpl"}
