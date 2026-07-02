<!-- plugins:js -->
<script src="{{ asset('mitra/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- Plugin js for this page -->
<script src="{{ asset('mitra/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('mitra/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('mitra/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('mitra/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('mitra/js/off-canvas.js') }}"></script>
<script src="{{ asset('mitra/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('mitra/js/template.js') }}"></script>
<script src="{{ asset('mitra/js/settings.js') }}"></script>
<script src="{{ asset('mitra/js/todolist.js') }}"></script>
<script src="{{ asset('mitra/js/dashboard.js') }}"></script>
<script src="{{ asset('mitra/js/Chart.roundedBarCharts.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>  

@include('components.toastr')

<script>
document.addEventListener('DOMContentLoaded', function() {  
    // Initialize Pusher  
    const pusher = new Pusher('8017cf302efe81abfde1', {  
        cluster: 'ap1'  
    });  
  
    // Subscribe to the notifications channel  
    const channel = pusher.subscribe('notifications');  
  
    // Listen for the NotificationSent event  
    channel.bind('App\\Events\\NotificationSent', function(data) {  
        const notification = data.notification;  
  
        // Tambahkan notifikasi baru ke daftar notifikasi  
        const notificationsList = document.querySelector('.notifications-list');  
        const newNotificationItem = document.createElement('li');  
        newNotificationItem.innerHTML = `  
            <a href="#" class="notification-item" data-id="${notification.id}">  
                <i class="icon-layout menu-icon"></i>  
                <span class="menu-title">${notification.message}</span>  
            </a>  
        `;  
        notificationsList.prepend(newNotificationItem);  
  
        // Perbarui jumlah notifikasi yang belum dibaca  
        const unreadNotificationsCountElement = document.querySelector('.badge.badge-danger.badge-pill');  
        let unreadCount = parseInt(unreadNotificationsCountElement.textContent);  
        unreadCount++;  
        unreadNotificationsCountElement.textContent = unreadCount;  
    });  
  
    // Menandai notifikasi sebagai dibaca saat diklik  
    document.addEventListener('click', function(event) {  
        if (event.target.classList.contains('notification-item')) {  
            const notificationId = event.target.getAttribute('data-id');  
            fetch(`/mitra/notifications/mark-as-read/${notificationId}`, {  
                method: 'POST',  
                headers: {  
                    'Content-Type': 'application/json',  
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  
                }  
            })  
            .then(response => response.json())  
            .then(data => {  
                if (data.success) {  
                    // Perbarui jumlah notifikasi yang belum dibaca  
                    const unreadNotificationsCountElement = document.querySelector('.badge.badge-danger.badge-pill');  
                    let unreadCount = parseInt(unreadNotificationsCountElement.textContent);  
                    unreadCount--;  
                    unreadNotificationsCountElement.textContent = unreadCount;  
  
                    // Ubah status notifikasi menjadi dibaca di UI  
                    event.target.classList.add('read');  
                }  
            });  
        }  
    });  
});  
</script>

