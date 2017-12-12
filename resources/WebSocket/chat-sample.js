var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '/chat-sample.html');
});

io.on('connection', function(socket){
    console.log('A user connected');

    //socket.broadcast.emit('hi');

    socket.on('chat message', function(msg){
        //console.log('message: ' + msg);
        io.emit('chat message', msg);
    });

    socket.on('disconnect', function(){
        console.log('User disconnected');
    });
});

http.listen(3001, function(){
    console.log('Server is running on port: 3001');
});