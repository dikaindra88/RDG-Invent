<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Onboard <?php $doc[0]['doc_onboard'] ?></title>
    <link rel="icon" href="img/logo1.png">
</head>

<body>
    <iframe src="<?= base_url('Document-Onboard/' . $doc[0]['doc_onboard']) ?>" frameBorder="0" style="margin: 0;" scrolling="auto" height="900" width="1300"></iframe>
</body>

</html>