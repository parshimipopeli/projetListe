<?php
require_once 'BDD/connexionBdd.php';
use BDD\connexionBdd;
$table = 'users';
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$tab = ['first_name' => $_POST["first_name"], 'lastName' => $_POST['lastName'], 'city' => $_POST['city'], 'street' => $_POST['street'], 'house_number' => $_POST['house_number'], 'phone_number' => $_POST['phone_number'],'email' => $_POST['email'], 'login' => $_POST['login'], 'password' => $pass];
$statements = connexionBdd::get_Instance()->insert($table, $tab);
$_POST['id'] = $statements->_LastInsertId;
echo "<tr role='row' class='odd'>
                            <td><a href='liste.php?id='{$_POST['id']}'>{$_POST['first_name'] }</a> </td>
                            <td>{$_POST['lastName'] }</td>
                            <td>{$_POST['street']}</td>
                            <td>{$_POST['city']}</td>
                            <td>{$_POST['house_number']}</td>
                             <td>{$_POST ['phone_number']}</td>
                            <td>{$_POST['email'] }</td>
                            <td>{$_POST['login'] }</td>
                            <td><a href='updateUsers.php?id='{$_POST['id']}'>update</a> </td>
                            <td><form method='post' >
                            <input type='hidden' name='user' value=' {$_POST ['id']}'>
                            <button type='submit' name='delete' >delete</button>
                            </form></td>
                        </tr>";