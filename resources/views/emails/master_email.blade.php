<html>
<head>

    <style>


    </style>
</head>
<body style="background-color: #e3e3e3">


<div style="margin-left: 10px;">
    <span style="font-weight: bold; font-size: 20px">{{$who}}</span> {!! $didwhat !!}
</div>
<div style="border: 1px solid black;margin-left: 10px; background-color: whitesmoke">
    <div>
        {!! $content !!}
    </div>
    <br>

</div>
<div style="margin-left: 10px;">
{{__('email.to_ticket')}} <a href="{{$ticket->getUrl()}}">{{$ticket->unique_id}}</a>
</div>

</body>
</html>
