// функция возвращает true, если первая дата строго больше второй
function is_first_date_greater(data1, data2){
    data1 = new Date (data1.split('.').reverse());
    data2 = new Date (data2.split('.').reverse());
    return data1 > data2;
}


function addData(chart, label, data) {
    if (chart.data.labels.at(-1) && is_first_date_greater(chart.data.labels.at(-1), label)){
        for (let i = 0; i < chart.data.labels.length; i++){
            // console.log(i);
            if (is_first_date_greater(chart.data.labels[i], label)){
                chart.data.labels.splice(i, 0, label);
                chart.data.datasets[0].data.splice(i, 0, data);
                break;
            }
        }
    } else {
        chart.data.labels.push(label);
        chart.data.datasets[0].data.push(data);
    }
    chart.update();
}

if (is_user_logged_in){
    current_user_date = current_user_date.map((item) => {date = new Date(item); return date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear()});
}

const chart_data = {
    labels: current_user_date,
    datasets: [{
        label: js_user_name + "weight dynamics",
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: current_user_weight,
    }]
};

/* console.log(current_user_weight); */

const chart_config = {
    type: 'line',
    data: chart_data,
    options: {
        responsive: true,
    }
};

const myChart = new Chart(
    document.getElementById('myChart'),
    chart_config
);
