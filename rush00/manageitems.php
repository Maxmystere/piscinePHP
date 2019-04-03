<?php
if ("/manageitems.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
session_start();
function list_items()
{
	$artarray = unserialize(file_get_contents('.private/articles'));
	return ($artarray);
}
function print_item_list($array, $admin)
{
	if ($admin == true)
		echo "<form action='./manageitems.php' method='POST' enctype='multipart/form-data'>";
	echo "<table>";
	echo "<tr><td>Name</td><td>Categorie</td><td>Price</td><td>Description</td><td>Image</td></tr>";
	foreach($array as $arrkey => $item)
	{
		echo "<tr>";
		foreach($item as $key => $data)
		{
			if ($key == 'picpath')
				echo "<td><img src='$data' alt='$data' height='20%' width'200vw'/></td>";
			else if ($key == 'category')
				echo "<td>".implode(", ", $data)."</td>";
			else if ($key == 'price')
				echo "<td>".$data." €</td>";
			else
				echo "<td>".$data."</td>";
		}
		if ($admin == true)
		{
			echo "<td><a href='manageitems.php?submit=MOD&key=".$arrkey."'>📝</a>";
			echo " <a href='manageitems.php?submit=DEL&name=".$item["name"]."'>❌</a></td>";
		}
		echo "</tr>";
	}
	if ($admin == true)
	{
		echo "<td><input type='text' name='name' value='' required/></td>";
		echo "<td><input type='text' name='category' value='' required/></td>";
		echo "<td><input type='text' name='price' value='' required/></td>";
		echo "<td><input type='text' name='description' value='' required/></td>";
		echo "<td><input type='file' name='fileToUpload' id='fileToUpload' accept='image/*' required/></td><td><input type='submit' name='submit' value='ADD' /></td>";
	}
	echo "</table>";
	if ($admin == true)
		echo "</form>";
}
function add_item($name, $price, $desc, $category, $admin)
{
	if ($admin == false)
		return (false);
	$artarray = unserialize(file_get_contents('.private/articles'));
	if (array_search($name, array_column($artarray, "name")))
		return (false);

	$newitem["name"] = $name;
	$newitem["category"] = explode(", ", $category);
	$newitem["price"] = $price;
	$newitem["desc"] = $desc;
	if ($_FILES["fileToUpload"]["size"] > 0)
		$newitem["picpath"] = ".private/img/".$name.'.'.end((explode(".", $_FILES["fileToUpload"]["name"])));
	else
		$newitem["picpath"] = ".private/img/".$name.".jpg";
	if ($_FILES["fileToUpload"]["size"] > 1024 * 1024
		&& explode("/", mime_content_type($_FILES["fileToUpload"]["tmp_name"]))[0] != "image")
		return (false);
	if ($_FILES["fileToUpload"]["size"] > 0 && !move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newitem["picpath"]))
		return (false);

	$artarray[] = $newitem;
	file_put_contents('.private/articles', serialize($artarray), LOCK_EX);
	return (true);
}
function mod_page($key, $admin)
{
	if ($admin == false)
		return (false);
	$artarray = unserialize(file_get_contents('.private/articles'));
	echo "<form action='./manageitems.php' method='POST' enctype='multipart/form-data'>";
	echo "<td><input type='hidden' name='key' id='key' value='".$key."' /></td>";
	echo "<td><input type='text' name='name' value='".$artarray[$key]["name"]."' required/></td>";
	echo "<td><input type='text' name='category' value='".implode(", ", $artarray[$key]["category"])."' required/></td>";
	echo "<td><input type='text' name='description' value='".$artarray[$key]["desc"]."' required/></td>";
	echo "<td><input type='text' name='price' value='".$artarray[$key]["price"]."' required/></td>";
	echo "<td><input type='file' name='fileToUpload' id='fileToUpload' accept='image/*'/></td><td><input type='submit' name='submit' value='MOD' /></td>";
	echo "</form>";
}
function mod_item($key, $name, $price, $desc, $category, $admin)
{
	if ($admin == false)
		return (false);
	$artarray = unserialize(file_get_contents('.private/articles'));
	if ($artarray[$key]["name"] != $name)
	{
		$artarray[$key]["name"] = $name;
		$newpath = ".private/img/".$name.'.'.end((explode(".", $artarray[$key]["picpath"])));
		if ($_FILES["fileToUpload"]["size"] > 0)
			unlink($artarray[$key]["picpath"]);
		else
			rename($artarray[$key]["picpath"], $newpath);
		$artarray[$key]["picpath"] = $newpath;
	}
	$artarray[$key]["price"] = $price;
	$artarray[$key]["desc"] = $desc;
	if ($_FILES["fileToUpload"]["size"] > 0)
	{
		if ($_FILES["fileToUpload"]["size"] > 1024 * 1024
			&& explode("/", mime_content_type($_FILES["fileToUpload"]["tmp_name"]))[0] != "image")
			return (false);
		if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $artarray[$key]["picpath"]))
			return (false);
	}
	$artarray[$key]["category"] = explode(", ", $category);
	file_put_contents('.private/articles', serialize($artarray), LOCK_EX);
}
function del_item($name, $admin)
{
	if ($admin == false)
		return (false);
	$array = unserialize(file_get_contents('.private/articles'));
	foreach($array as $key => $item)
	{
		if ($item["name"] == $name)
		{
			unlink($item["picpath"]);
			unset($array[$key]);
			// Do not rearange keys to keep cookie good
			//$array = array_values($array);
			file_put_contents('.private/articles', serialize($array), LOCK_EX);
			return (true);
		}
	}
	return (false);
}
$isadmin = ($_SESSION['login'] == 'root');
if ($_POST["submit"] == "ADD")
{
	add_item($_POST["name"], $_POST["price"], $_POST["description"], $_POST["category"], $isadmin);
	header("Location: articles.php");
}
else if ($_POST["submit"] == "MOD")
{
	mod_item($_POST["key"], $_POST["name"], $_POST["price"], $_POST["description"], $_POST["category"], $isadmin);
	header("Location: articles.php");
}
else if ($_GET["submit"] == "MOD")
{
	mod_page($_GET["key"], $isadmin);
	//header("Location: articles.php");
}
else if ($_GET["submit"] == "DEL")
{
	del_item($_GET["name"], $isadmin);
	header("Location: articles.php");
}
?>
