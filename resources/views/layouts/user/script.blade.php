<script src="{{ asset('mitra/vendors/js/vendor.bundle.base.js') }}"></script>
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
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var canvas = document.getElementById("myChart");
        if (canvas) {
            var ctx = canvas.getContext("2d");
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei'],
                    datasets: [{
                        label: 'Pekerjaan Selesai',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: 'rgba(79, 70, 229, 0.7)',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
    });
</script>