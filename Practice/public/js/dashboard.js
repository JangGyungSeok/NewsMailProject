var mailSendLogTable = document.getElementById('mailSendLogTable');
var mailSendLogTableBody = document.getElementById('mailSendLogTableBody');
var mailSendLogs = JSON.parse(mailSendLogTable.dataset.mailSendLog);
// console.log(mailSendLogs);

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

        $('#mailSendLogChart').click(
            function (e) {
                var activePoints = mailSendLogChart.getElementsAtEvent(e);

                if (activePoints.length >1){
                    var selectedIndex = activePoints[0]._index;
                    var selectedDate = mailSendLogChart.data.labels[selectedIndex];
                    var trs = mailSendLogTableBody.children;
                    for (var i=0; i< trs.length; i++) {
                        trs[i].style.backgroundColor = "white";
                        if (trs[i].children[0].textContent.trim() == selectedDate.trim()) {
                            trs[i].style.backgroundColor = "rgba(255,0,0,0.3)";
                        }
                    }
                }

            }
        );

    }
)


