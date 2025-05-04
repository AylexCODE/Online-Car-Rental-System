const socket = io('http://localhost:3000');

socket.on('connect', () => {
    console.log('Realtime Update is Active');
});

socket.on('disconnect', () => {
    console.log('Realtime is not realtiming');
});