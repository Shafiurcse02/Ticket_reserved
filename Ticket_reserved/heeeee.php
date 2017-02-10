<form action="admin_pag_hotel_13.php" method="POST">
                                <table id="admin_page_first_table">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/room_id.png" width="60" height="16"></td>
                                        <td><input type="text" name="admin_room_no" maxlength="9" /></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/adult.png" width="60" height="16"></td>
                                        <td>
                                            <select name="admin_adult">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/child.png" width="60" height="16"></td>
                                        <td>
                                            <select name="admin_child">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td> <img src="images/ac_nonac.png" width="100" height="16"></td>
                                        <td>
                                            <select name="admin_ac_nonac">
                                                <option value="AC">AC</option>
                                                <option value="Non_AC">Non AC</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/room_cost.png" width="100" height="16"></td>
                                        <td><input type="text" name="admin_room_cost" maxlength="4" /></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="left"><input type="reset" value="reset"></td>
                                        <td  align="right"><input type="submit" name="admin_room_insert" title="insert Room" value=" Press "></td>
                                    </tr>
                                </table>
                            </form>
                            <h2> Room Delete </h2>
                            <form action="admin_pag_hotel_13.php" method="POST">
                                <table id="admin_page_first_table">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/room_id.png" width="60" height="16"></td>
<!--                                        <td><input type="text" name="admin_room_delete_id" maxlength="9"/></td>-->
                                        <td>
                                            <select name="admin_room_delete_id">
                                                <?php
                                                $Result = mysql_query(
                                                        "SELECT `room_no` FROM `room` WHERE 1");
                                                if (!$Result)
                                                    echo mysql_error();
                                                else {
                                                    while ($row = mysql_fetch_array($Result)) {
                                                        $row = array_unique($row);
                                                        foreach ($row as $value) {
                                                            echo '<option value=' . $value . '>' . $value . '  ' . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="left"><input type="reset" value="reset"></td>
                                        <td align="right"><input type="submit" name="admin_room_insert" title="Delete Room" value=" Press "></td>
                                    </tr>
                                </table>
                            </form>
                            <h2> Delete Customer Resistration</h2>
                            <form action="admin_pag_hotel_13.php" method="POST">
                                <table id="admin_page_first_table">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/user_name.png" width="80" height="16"></td>
                                        <td><input type="text" name="admin_user_delete_name" maxlength="40" /></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/user_email.png" width="80" height="16"></td>
                                        <td><input type="email" name="admin_user_delete_email" maxlength="40"  /></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/user_phone.png" width="80" height="16"></td>
                                        <td><input type="tex" name="admin_user_delete_phone" maxlength="15"  /></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="left"><input type="reset" value="reset"></td>
                                        <td align="right"><input type="submit" name="admin_room_insert" title="Delete Customer" value=" Enter"></td>
                                    </tr>
                                </table>
                            </form>
