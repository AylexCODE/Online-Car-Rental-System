const socket = io('https://socketio-f317.onrender.com');

socket.on('connect', () => {
    console.log('Realtime Update is Active');
});

socket.on('disconnect', () => {
    console.log('Realtime is not realtiming');
});