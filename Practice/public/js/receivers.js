var receiversTable = document.getElementById('receiversTable');
var receiversTableBody = document.getElementById('receiversTableBody');
var receivers = JSON.parse(receiversTable.dataset.allReceivers);
var receiversSendReservationTime = []

for (i in receivers){
    receiversSendReservationTime.push(receivers[i].send_reservation_time);
}

time = []
reservationTime = []
for (var i=10;i<24;i++) {
    time.push(i.toString() + ":00:00");
    reservationTime.push(receiversSendReservationTime.filter(temp => temp == i.toString() + ":00:00").length);
}

console.log(reservationTime);

$(document).ready(
    function () {
        var ctx = document.getElementById('receiversChart');
        var receiversChart = new Chart(ctx,{
            type: 'bar',
            data: {
                labels: time,

                datasets: [{
                    label: 'reservationTime',
                    data: reservationTime,
                    backgroundColor: [
                        'rgba(0, 255, 0, 0.2)',
                        'rgba(0, 255, 50, 0.2)',
                        'rgba(0, 255, 100, 0.2)',
                        'rgba(0, 255, 150, 0.2)',
                        'rgba(0, 255, 200, 0.2)',
                        'rgba(50, 255, 0, 0.2)',
                        'rgba(100, 255, 0, 0.2)',
                        'rgba(150, 255, 0, 0.2)',
                        'rgba(200, 255, 0, 0.2)',
                        'rgba(50, 255, 50, 0.2)',
                        'rgba(100, 255, 100, 0.2)',
                        'rgba(150, 255, 150, 0.2)',
                        'rgba(200, 255, 200, 0.2)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        $('#receiversChart').click(
            function (e) {
                var activePoints = receiversChart.getElementsAtEvent(e);

                if (activePoints.length >0){
                    // alert('클릭');
                    var selectedIndex = activePoints[0]._index;
                    var selectedTime = receiversChart.data.labels[selectedIndex];
                    var trs = receiversTableBody.children;
                    for (var i=0; i< trs.length; i++) {
                        trs[i].style.backgroundColor = "white";
                        if (trs[i].children[3].textContent.trim() == selectedTime.trim()) {
                            trs[i].style.backgroundColor = "rgba(255,0,0,0.3)";
                        }
                    }
                }
            }
        )
    }
)
