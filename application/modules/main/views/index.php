<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View data</title>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>
<body>
    <center>
    <div class="container">
            <div class="row mb-2">
                <label class="heading3">ALL DATA
                    &nbsp;&nbsp;
                    <a href="<?=base_url('add')?>">ADD DATA</a>
                </label>
                
                <span class="f-right">
                    <form class="" action="<?=base_url('search')?>" method="post">
                        <input class="search-field" type="text" name="search_key" placeholder="Search Name...">
                        <button type="submit" class="form-button">Search</button>
                    </form>
                </span>
            </div>
            <br>
            <table id='data'>
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data) && !empty($data)) { 
                        foreach($data as $k=>$d) { ?>
                    <tr>
                        <td><?=$k+1?></td>
                        <td><img src="<?=json_decode($d->image)[0]?>" alt="" width="50px"></td>
                        <td><?=$d->name?></td>
                        <td><?=$d->amount?></td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="4"><center><b>No Results Found!!!</b></center></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </center>
</body>
</html>