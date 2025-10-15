<?php include 'includes/header.php'; ?>
<form action="create.php" method="POST" enctype="multipart/form-data">
    <h2>Create Your Profile</h2>
    <label>Name: <input type="text" name="name" required></label>
    <label>Email: <input type="email" name="email" required></label>
    <label>Bio: <textarea name="bio"></textarea></label>
    <label>Image: <input type="file" name="image" accept="image/*" required></label>
    <button type="submit">Submit</button>
</form>
<?php include 'includes/footer.php'; ?>
