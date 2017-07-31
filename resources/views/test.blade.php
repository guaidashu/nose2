<body>
	我试试看视图
	<br />
	{{$name}}
	<br />
	{{$email}}
	<br />
    Here is an image:
    <img src="{{$message->embedData($img, '2.jpg')}}" />
</body>