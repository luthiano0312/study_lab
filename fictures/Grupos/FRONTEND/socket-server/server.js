import { Server } from "socket.io";

const io = new Server(3001, {
  cors: {
    origin: "*"
  }
});

io.on("connection", (socket) => {
  console.log("Usuário conectado");

  socket.on("send_message", (data) => {
    io.emit("receive_message", data);
  });
});