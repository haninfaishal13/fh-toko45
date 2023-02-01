getData()

const statistic_product = document.getElementById('statistic-product').getContext('2d')
const statistic_transaction = document.getElementById('statistic-transaction').getContext('2d')

getStatistic()

function getData() {
    const url = base_url + '/backsite/dashboard/getData';
    fetch(url, {
        method: 'get'
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById('category-count').innerHTML = data.data.category
        document.getElementById('product-count').innerHTML = data.data.product
        document.getElementById('transaction-count').innerHTML = data.data.transaction
        document.getElementById('user-count').innerHTML = data.data.user
    })
}

function getStatistic(month = '', year = '') {
    let params = {}
    if(month) params.month = month;
    if(year) params.year = year;
    let urlParams = new URLSearchParams(params)
    let url = base_url + '/backsite/dashboard/getStatistic?' + urlParams

    fetch(url, {
        method: 'get'
    })
    .then((response) => response.json())
    .then((data) => {
        showChartTransaction(data.data.transaction_total)
        showChartProduct(data.data.transaction_product_permonth)
    })
}

function showChartTransaction(dataTransaction) {
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    let data = [];
    for(let i=0 ; i<dataTransaction.length ; i++) {
        data.push(dataTransaction[i].count);
    }

    const config_chart_transaction_line = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transaksi dalam setahun',
                data: data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            maintainAspectRatio: false,
        }

    }
    new Chart(statistic_transaction, config_chart_transaction_line);
}

function showChartProduct(dataProduct) {
    let labels = [];
    let data = [];
    let backgroundColor = [];
    for(let i=0 ; i<dataProduct.length ; i++) {
        labels.push(dataProduct[i].name);
        data.push(dataProduct[i].quantity);
        backgroundColor.push('#' + Math.floor(Math.random()*16777215).toString(16));
    }

    const config_chart_product_pie = {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: data,
                    backgroundColor : backgroundColor,
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
        }

    }
    new Chart(statistic_product, config_chart_product_pie);
}
