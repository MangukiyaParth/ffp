<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Excel Data</title>
</head>
<body>
    <form action="<?php echo base_url('admin/ImportPaidUser/import_excel'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <br><br>
        <input type="submit" value="Import" />
    </form>
</body>
</html>
