var mailSendLogTable = document.getElementById('mailSendLogTable');
var mailSendLogs = JSON.parse(mailSendLogTable.dataset.mailSendLog);
console.log(mailSendLogs);

dates=[]
send_success=[]
send_fail=[]

for(log in mailSendLogs){
    console.log(mailSendLogs[log]);
    dates.push(mailSendLogs[log].mail_date);
    send_success.push(mailSendLogs[log].send_success);
    send_fail.push(mailSendLogs[log].send_fail);
}

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'SendSuccess',
            data: send_success,
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
            data: send_fail,
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

