getData()

function getData(type='all', order='') {
    const table_transaction_body = document.getElementById('table-transaction-body')
    let url = base_url + '/backsite/transaction/getData'
    params = {}
    if(type == 'order') {
        table_transaction_body.innerHTML = ''
        params.order = order
        const urlParams = new URLSearchParams(params)
        url += '?' + urlParams
    }
    console.log(url);
    fetch(url, {
        method: 'get',
    })
    .then((response) => response.json())
    .then((data) => {
        let html = ''
        if(data.data.data.length > 0) {
            for(let i=0 ; i<data.data.data.length ; i++) {
                const value = data.data.data[i]
                html += `
                <tr>
                    <td>-</td>
                    <td>Rp ${value.total_price}</td>
                    <td>${value.created_at}</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm" title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-outline-warning btn-sm" title="Edit">
                            <i class="far fa-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                `
            }
        } else {
            html += `
                <tr>
                    <td colspan="4">
                        Tidak ada transaksi
                    </td>
                </tr>
            `
        }
        table_transaction_body.insertAdjacentHTML('beforeend',html)
    })

}
