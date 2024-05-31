const io = require('socket.io')(6001, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

io.on('connection', (socket) => {
    console.log('New client connected');

    socket.on('logout', (data) => {
        io.to(data.userId).emit('remote-logout', data);
    });

    socket.on('join', (userId) => {
        socket.join(userId);
    });

    socket.on('disconnect', () => {
        console.log('Client disconnected');
    });
});