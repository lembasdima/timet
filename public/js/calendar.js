/**
 * Created by Dima on 25.02.2017.
 */

var calendar = new Date();
var dd = calendar.getDate();
var mm = calendar.getMonth() + 1;
var year = calendar.getFullYear();

var daysName = new Array("Пон","Вт","СР");


function getDaysArray(year, month) {
    var numDaysInMonth, daysInWeek, daysIndex, index, i, l, daysArray;

    numDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    daysIndex = { 'Sun': 0, 'Mon': 1, 'Tue': 2, 'Wed': 3, 'Thu': 4, 'Fri': 5, 'Sat': 6 };
    index = daysIndex[(new Date(year, month - 1, 1)).toString().split(' ')[0]];
    daysArray = [];

    for (i = 0, l = numDaysInMonth[month - 1]; i < l; i++) {
        daysArray.push((i + 1) + '. ' + daysInWeek[index++]);
        if (index == 7) index = 0;
    }

    return daysArray;
}

document.write(getDaysArray(year, mm));