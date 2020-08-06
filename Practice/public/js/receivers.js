var receiversTable = document.getElementById('receiversTable');
var receiversTableBody = document.getElementById('receiversTableBody');
var receivers = getAllReceiver();
var receiversSendReservationTime = []
var time = []
var reservationTime = []

for (i in receivers){
    receiversSendReservationTime.push(receivers[i].send_reservation_time);
}


for (var i=10;i<24;i++) {
    time.push(i.toString() + ":00:00");
    reservationTime.push(receiversSendReservationTime.filter(temp => temp == i.toString() + ":00:00").length);
}


var chartData = {
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
};





$(document).ready(
    function () {
        var ctx = document.getElementById('receiversChart');
        var receiversChart = new Chart(ctx,chartData);

        $('#receiversChart').click(
            function (e) {
                var activePoints = receiversChart.getElementsAtEvent(e);

                if (activePoints.length >0){
                    var selectedIndex = activePoints[0]._index;
                    var selectedTime = receiversChart.data.labels[selectedIndex];
                    var trs = receiversTableBody.children;


                    $.ajax({
                        type:'GET',
                        url:'/getReceiverBySendReservationTime',
                        data:{sendReservationTime:selectedTime.trim()},

                        success:function(data) {
                            updateReceiverTable(receiversTableBody, data);


                        }
                    })
                } else {
                    $.ajax({
                        type:'GET',
                        url:'/getAllReceiver',

                        success:function(data) {
                            updateReceiverTable(receiversTableBody, data);
                        }
                    })
                }
            }
        )
    }
)


function getAllReceiver() {
    var result;
    $.ajax({
        type:'GET',
        url:'/getAllReceiver',
        async: false,
        success:function(data) {
            result = JSON.parse(data);
        }
    });
    return result;
}

function updateReceiverTable(table, data){
    receiverData = JSON.parse(data);
    // console.log(JSON.parse(data).length);

    table.innerHTML = '';

    for (i in receiverData) {
        var receiverTr = document.createElement('tr');
        var idx = document.createElement('td');
        idx.innerText = receiverData[i].idx;
        var email = document.createElement('td');
        email.innerText = receiverData[i].email;
        var name = document.createElement('td');
        name.innerText = receiverData[i].name;
        var send_reservation_time = document.createElement('td');
        send_reservation_time.innerText = receiverData[i].send_reservation_time;

        receiverTr.appendChild(idx);
        receiverTr.appendChild(email);
        receiverTr.appendChild(name);
        receiverTr.appendChild(send_reservation_time);

        table.appendChild(receiverTr);
    }
}
