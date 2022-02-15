function display_book_form($book = '') {
// This displays the book form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters. This will set $edit
// to false, and the form will go to insert_book.php.
// To update, pass an array containing a book. The
// form will be displayed with the old data and point to update_book.php.
// It will also add a "Delete book" button.
// if passed an existing book, proceed in "edit mode"
$edit = is_array($book);
// most of the form is in plain HTML with some
// optional PHP bits throughout
?>
<style type="text/css">
body{background-color:lightgrey;padding:10px;}
input{padding:10px;background-color:lightgrey;border:none;}
.add{background-color:#6495ed;border:none;border-radius:10px;color:white;box-shadow:0 0 15px #555;margin:20px;}
.submit{background-color:red;border:none;border-radius:10px;color:white;box-shadow:0 0 15px #555;margin:20px;}
.update{background-color:#228b22;color:white;font-size:100%;border:none;border-radius:10px;box-shadow:0 0 15px #555;margin:20px;}
table{background-color:#00008b;color:white;border-radius:10px;padding:5px;}
td{padding:10px;}
</style>
<body>
<form method="post"action="<?php echo $edit ? 'edit_book.php' : 'insert_book.php';?>">
<table border="1">
<tr>
<td>ISBN:</td>
<td><input type="text" name="isbn"
value="<?php echo $edit ? $book['isbn'] : ''; ?>" /></td>
</tr>
<tr>
<td>Post title</td>
<td><input type="text" name="title"
value="<?php echo $edit ? $book['title'] : ''; ?>" /></td>
</tr>
<tr>
<td>Author</td>
<td><input type="text" name="author"
value="<?php echo $edit ? $book['author'] : ''; ?>" /></td>
</tr>
<tr>
<td>Category / link:</td>
<td><select name="catid">
<?php
// list of possible categories comes from database
$cat_array=get_categories();
foreach ($cat_array as $thiscat) {
echo "<option value=\"".$thiscat['catid']."\"";
// if existing book, put in current catgory
if (($edit) && ($thiscat['catid'] == $book['catid'])) {
echo " selected";
}
echo ">".$thiscat['catname']."</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>Description:</td>
<td><textarea rows="3" cols="50"
name="description">
<?php echo $edit ? $book['description'] : ''; ?>
</textarea></td>
</tr>
<tr>
<td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
<?php
if ($edit)
// we need the old isbn to find book in database
// if the isbn is being updated
echo "<input type=\"hidden\" name=\"oldisbn\"
value=\"".$book['isbn']."\" />";
?>
<input class="update" type="submit"value="<?php echo $edit ? 'Update' : 'Add'; ?> Book" />
</form></td>
<?php
if ($edit) {
echo "<td>
<form method=\"post\" action=\"delete_book.php\">
<input class="add" type=\"hidden\" name=\"isbn\"value=\"".$book['isbn']."\" />
<input class="delete" type=\"submit\" value=\"Delete book\"/>
</form></td>";
}
?>
</td>
</tr>
</table>
</form>
</body>
<?php
}