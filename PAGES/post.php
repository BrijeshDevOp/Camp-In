<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }

        body .container
        {
            width:30%;
            height:70%;
            border:1px solid black;
        }

        body .post_btns
        {
            width:30%;
            height:10%;
            border:1px solid black;
        }

        .post_btns
        {
            display:grid;
            grid-template-columns:1fr 1fr;
        }

        .post_btns .btn_cancel
        {
            background:red;
            height:100%;
        }

        .post_btns .btn_post
        {
            background:green;
            height:100%;
            display:flex;
            justify-content:center;
            align-items:center;
        }

    </style>
</head>

<body>
    <div class="container"></div>
    <div class="post_btns">
        <div class="btn_cancel">POST</div>
        <div class="btn_post">CANCEL</div>
    </div>
</body>
</html>