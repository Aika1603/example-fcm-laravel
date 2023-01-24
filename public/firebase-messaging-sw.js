self.addEventListener("push", function (event) {
    var title = event.data.json().notification.title;
    var body = event.data.json().notification.body;
    var click_action = event.data.json().data.url; //custom link

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: './images/512-icon.png',
            sound: 'default',
            data: {
                url: click_action,
            }
        })
    );
});

self.addEventListener("notificationclick", function (event) {
    event.notification.close();
    event.waitUntil(clients.openWindow(event.notification.data.url));
});
