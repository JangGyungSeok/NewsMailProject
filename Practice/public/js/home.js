var mailSendLogData = document.getElementById('mailSendLogData');
var mailSendLogs = JSON.parse(mailSendLogData.dataset.mailSendLog);

dates=[]
total_send = []
send_success=[]
send_fail=[]

for(log in mailSendLogs){
    // console.log(mailSendLogs[log]);
    dates.push(mailSendLogs[log].mail_date);
    total_send.push(mailSendLogs[log].total_send)
    send_success.push(mailSendLogs[log].send_success);
    send_fail.push(mailSendLogs[log].send_fail);
}

//  =============================================================================

var receiversData = document.getElementById('allReceiversData');
var receivers = JSON.parse(receiversData.dataset.allReceivers);
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
    }
)


$(document).ready(
    function () {
        var ctx = document.getElementById('mailSendLogChart');
        var mailSendLogChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates.reverse(),
                datasets: [{
                    label: 'SendSuccess',
                    data: send_success.reverse(),
                    backgroundColor: [
                        'rgba(0, 255, 0, 0.2)',
                    ],
                    borderColor: [
                        'rgba(0, 255, 0, 1)',
                    ],
                    borderWidth: 2
                }
                ,{
                    label: 'SendFail',
                    data: send_fail.reverse(),
                    backgroundColor:[
                        'rgba(255, 0, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(255, 0, 0, 1)'
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

    }
)
