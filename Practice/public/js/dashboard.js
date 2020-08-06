var mailSendLogTable = document.getElementById('mailSendLogTable');
var mailSendLogTableBody = document.getElementById('mailSendLogTableBody');
var mailSendLogs = getAllSendMailLog();

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
                    // mailSendLogTableBody
                    var selectedIndex = activePoints[0]._index;
                    var selectedDate = mailSendLogChart.data.labels[selectedIndex];

                    $.ajax({
                        type: 'GET',
                        url: '/getSendMailLogByMailDate',
                        data:{mailDate:selectedDate.trim()},
                        success:function(data) {
                            updateSendMailLogTable(mailSendLogTableBody, data);
                        }
                    })

                } else {
                    $.ajax({
                        type:'GET',
                        url:'/getAllSendMailLog',
                        success:function(data) {
                            updateSendMailLogTable(mailSendLogTableBody, data);
                        }
                    });
                }

            }
        );

    }
)


function getAllSendMailLog() {
    var result;
    $.ajax({
        type:'GET',
        url:'/getAllSendMailLog',
        async: false,
        success:function(data) {
            result = JSON.parse(data);
        }
    });
    return result;
}


function updateSendMailLogTable(table, data){
    sendMailLog = JSON.parse(data);
    // console.log(JSON.parse(data).length);

    table.innerHTML = '';

    for (i in sendMailLog) {
        var mailSendLogTr = document.createElement('tr');

        var mail_date = document.createElement('td');
        mail_date.innerText = sendMailLog[i].mail_date;

        var detail = document.createElement('td');
        var aTag = document.createElement('a');
        aTag.href = '/dashBoard/mailSendLog/mailSendLogDetail/'+sendMailLog[i].mail_date
        aTag.innerText = '상세보기';
        detail.appendChild(aTag);

        var total_send = document.createElement('td');
        total_send.innerText = sendMailLog[i].total_send;

        var send_success = document.createElement('td');
        send_success.innerText = sendMailLog[i].send_success;

        var send_fail = document.createElement('td');
        send_fail.innerText = sendMailLog[i].send_fail;

        mailSendLogTr.appendChild(mail_date);
        mailSendLogTr.appendChild(detail);
        mailSendLogTr.appendChild(total_send);
        mailSendLogTr.appendChild(send_success);
        mailSendLogTr.appendChild(send_fail);

        table.appendChild(mailSendLogTr);
    }
}


{/* <th> {{$log->mail_date}} </th>
<td> <a href='/dashBoard/mailSendLog/mailSendLogDetail/{{$log->mail_date}}'>상세보기</a> </td>
<td> {{$log->total_send}} </td>
<td> {{$log->send_success}} </td>
<td> {{$log->send_fail}} </td> */}
