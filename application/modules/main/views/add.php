<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add data</title>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>
<body>
    <center>
        <div class="container">
            <h3>ADD DATA</h3>
            <form class="form-group" action="<?=base_url('submit')?>" method="post" enctype="multipart/form-data">
                <label class="form-label" for="name">Enter Name</label>
                <input class="form-input" id="name" name="name" placeholder="Enter name" required="true" type="text">

                <label class="form-label" for="amount">Enter Amount</label>
                <input class="form-input" type="text" id="amount" name="amount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Enter Amount" required="true">

                <label class="form-label" for="photo">Upload Image</label>
                <input accept="image/*" class="form-input" id="photo" name="photo" type="file" required>
            
                <input type="submit" value="Submit">
            </form>
        </div>
    </center>
</body>
</html>