var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var sleep = require('thread-sleep');


app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});

http.listen(3000, function () {
    console.log('listening on *:3000');
});

io.on('connection', function (socket) {
    console.log('a user connected');
    socket.on('disconnect', function () {
        console.log('user disconnected');
    });
    socket.on('form step 1', function (msg) {
        console.log('data form step 1: ');
        console.log(msg);
        var res = sleep(2000);
        socket.emit('form step 1', 'ok');

    });
    socket.on('form step 2', function (msg) {
        console.log('data form step 2: ');
        console.log(msg);
        socket.emit('form step 2', 'ok');
    });
});
