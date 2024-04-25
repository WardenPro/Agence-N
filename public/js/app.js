document.addEventListener('DOMContentLoaded', function() {
    updateNotificationCount();

    // Mise à jour périodique si nécessaire
    // setInterval(updateNotificationCount, 30000);
});

function updateNotificationCount() {
    fetch('/notification/count')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const notificationIcon = document.querySelector('.fa-bell');
            const count = data.count;

            let counterSpan = notificationIcon.querySelector('.notification-count');
            if (!counterSpan) {
             
                counterSpan = document.createElement('span');
                counterSpan.classList.add('notification-count');
                notificationIcon.style.position = 'relative'; // Assurez-vous que la cloche a une position relative
                notificationIcon.appendChild(counterSpan);
            }
            
            counterSpan.textContent = count > 0 ? count : '';
            counterSpan.style.display = count > 0 ? 'block' : 'none';
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}