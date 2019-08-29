var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

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
        socket.emit('form step 1', '<ul class=" mb-5 nav nav-pills" nav >\n' +
            '                <li class="nav-item">\n' +
            '                    <a class="nav-link">Step 1</a>\n' +
            '                </li>\n' +
            '                <li class="nav-item">\n' +
            '                    <a class="nav-link active">Step 2</a>\n' +
            '                </li>\n' +
            '\n' +
            '            </ul>\n' +
            '                <form step2 method="post">\n' +
            '                    <fieldset>\n' +
            '                        <legend>Enter verify code</legend>\n' +
            '\n' +
            '                        <div class="form-group">\n' +
            '                            <label >Код</label>\n' +
            '                            <input type="text" class="form-control" name="code" placeholder="Код">\n' +
            '                        </div>\n' +
            '                        <button type="submit" class="btn btn-primary">Submit</button>\n' +
            '                    </fieldset>\n' +
            '                </form>');

    });
    socket.on('form step 2', function (msg) {
        console.log('data form step 2: ');
        console.log(msg);
        socket.emit('form step 2', '<h5>Success</h5>');
    });
});
