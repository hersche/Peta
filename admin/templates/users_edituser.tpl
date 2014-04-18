{include file="header.tpl" title=Usermanagement} {include file="menu.tpl"} {include file="messagebox.tpl"}
<form action="user.php?action=mkedit&userid={$userid}" method="post">
    <table>

        <tr>
            <td>Username:</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="username" readonly="readonly" value="{$username}" />
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
        <td>Userrole:</td>
        <td>
            <ul>
                 {section name=role loop=$selectedRoles}
                <li>{$selectedRoles[role]->getRole()} DEBUG-ID's:{$selectedRoles[role]->getId()}
                    <input type="checkbox" name="role_{$selectedRoles[role]->getId()}" value="{$selectedRoles[role]->getId()}" checked="checked">
                </li>
                {/section}
			</ul>
			<ul>
                {section name=rrole loop=$restRoles}
                <li>{$restRoles[rrole]->getRole()} DEBUG-ID's:{$restRoles[rrole]->getId()}
                    <input type="checkbox" name="role_{$restRoles[rrole]->getId()}" value="{$restRoles[rrole]->getId()}">
                </li>
				 {/section} 
			</ul>
                </select>

                </tr>


                <tr>
                    <td>Realy want to edit the user?</td>
                    <td>
                        <input type="checkbox" name="sure" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Edit now!" />
                    </td>

                </tr>
    </table>

</form>
{include file="footer.tpl"}
