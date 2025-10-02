<html>

<head>
    <title>Upload Form</title>
</head>

<body>
    <?php print_r($errors); ?>
    <?php //echo form_open_multipart('demo/doupload'); 
    ?>

    <!--   <form action="" method="">
        <input type="file" name="userfile[]" size="20" />
        <br /><br />
        <input type="submit" value="upload" />
    </form> -->
    <img src="<?php echo base_url('media/upload/') . $this->session->userdata('name'); ?>" width="500">

    <br />
    <br />
    <br />
    <a href="<?php echo base_url("makePost/makePost/1/4"); ?>">Click Me</a>
</body>

</html>