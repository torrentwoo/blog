/**
 * The file can be monitored by Supervisor
 */

var app = require('http').Server();
var io = require('socket.io')(app);

// @see https://npm.taobao.org/package/ioredis
var Redis = require('ioredis');
var redis = new Redis(
    /*{
        port: 6379,
        host: '127.0.0.1',
        family: 4,
        db: 3
    }*/
); // default connect to 127.0.0.1:6379

app.listen(3000, function() {
    console.log('Server is running');
});

/*
redis.subscribe('public-channel');

redis.on('message', function(channel, message) {
    console.log(message);
})*/

redis.psubscribe('*', function(error, count) {
    console.log(count + ' channel been subscribed');
});

redis.on('pmessage', function(pattern, channel, message) {
    //console.log(pattern, channel, message);
    //console.log(pattern); // will be return *
    //console.log(channel); // returns channel name
    //console.log(message); // returns message
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
