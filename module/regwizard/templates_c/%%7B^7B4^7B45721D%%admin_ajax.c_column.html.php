<?php /* Smarty version 2.6.18, created on 2009-08-31 00:45:16
         compiled from admin_ajax.c_column.html */ ?>
<table width="255" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <span class="column_title">當使用者的</span>
    <select name="rwo_c_column" id="rwo_c_column" onChange="request_html_column('c_value');">
       <option value="none" selected>--請選擇--</option>
       <option value="sex">性別</option>
       <option value="department">系所</option>
    </select>
    <span class="column_title">的值</span>
    </td>
  </tr>
  <tr>
    <td><div id="c_value_result"></div></td>
  </tr>
  <tr>
    <td><div id="c_type_result"></div></td>
  </tr>
</table>