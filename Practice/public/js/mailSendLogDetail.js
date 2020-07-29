var receiveTimeLogTable = document.getElementById('receiveTimeLogTable');
var receiveTimeLog = JSON.parse(receiveTimeLogTable.dataset.field);
// var receiveTimeLog = receiveTimeLogTable.dataset.field;
// var receiveTimeLog = eval("("+receiveTimeLogTable.dataset.field+")");

console.log(receiveTimeLog[0]['enter_time']);
console.log(receiveTimeLog.length);
