import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: "eu",
    forceTLS: true,
});

// window.Echo.channel("test").listen("TestEvent", function (e) {
//     alert("hay");
// });
// console.log("TestEvent");
