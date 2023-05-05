<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="{{route('index.group1');}}" ;?>index.group1</a>
    <br>
    <a href="{{route('index.test');}}" ;?>index.test</a>
    <br>
    <a href="<?= route('index.test2',['id'=>100,'slug'=>'a']    ); ?>">index.test2</a>
</body>

</html>