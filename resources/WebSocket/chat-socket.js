/**
 * The file can be monitored by Supervisor
 */

// Attaches socket.io to Node.js HTTP server (will be listening on port 3000)
var app = require('http').Server();
var io = require('socket.io')(app);

// Import Redis, and connect to Redis server instantly while Redis instance is created
var Redis = require('ioredis');
// @link https://www.npmjs.com/package/ioredis
// @link https://npm.taobao.org/package/ioredis
var redis = new Redis(
    {
        host: '127.0.0.1', // host
        port: 6379, // port
        family: 4, // 4, IPv4 or 6, IPv6

        retryStrategy: function(timeout) {
            var delay = Math.min(timeout * 50, 2000);
            return delay;
        },
        reconnectOnError: function(error) {
            var targetError = 'READONLY';
            if (error.message.slice(0, targetError.length) === targetError) {
                // Only reconnect when the error starts with "READONLY"
                return true;
            }
        }
    }
); // by default, will be connected to 127.0.0.1:6379

app.listen(3000, function() {
    var d = new Date();
    var datetime = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate()
        + ' '
        + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
    console.log('[' + datetime + '] Node.js HTTP server is online');
});

/*
// Subscribe one specified channel
redis.subscribe('public-channel', function(error, count) {
    // `count` represents the number of channels we are currently subscribed to
});
redis.on('message', function(channel, message) {
    console.log('Receive message %s from channel %s', message, channel);
});*/

// Subscribes the client to the given patterns
redis.psubscribe('*', function(error, count) {
    var d = new Date();
    var datetime = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate()
        + ' '
        + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
    console.log('[' + datetime + '] All available channels have been subscribed via the pattern wildcard');
});
redis.on('pmessage', function(pattern, channel, message) {
    //console.log(pattern, channel, message);
    //console.log(pattern); // will be return *
    //console.log(channel); // returns the channel name
    //console.log(message); // returns message
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
