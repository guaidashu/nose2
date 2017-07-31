<body>
	我试试看视图
	<br />
	{{$name}}
	<br />
	{{$email}}
	<br />
    Here is an image:
    <img width="150px" src="<?php echo $message->embed($img); ?>" />
</body>