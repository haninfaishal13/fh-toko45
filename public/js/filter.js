const btn_reset = document.getElementById('reset-filter')

selectCategoryOption()
selectOrderPriceOption()
selectOrderStockOption()

function selectCategoryOption() {
    const url = base_url + '/filter/select-category-toko'
    fetch(url, {
        method: 'get'
    })
    .then((response) => response.json())
    .then((data) => {
        const select_category = document.getElementById('filter-category')
        let html = `<option value="">Pilih Kategori</option>`

        for(let i=0 ; i<data.data.length ; i++) {
            const value = data.data[i]
            html += `<option value="${value.id}">${value.text}</option>`
        }
        console.log(html)
        select_category.innerHTML = html
    })
}

function selectOrderPriceOption() {
    const filter_order_price = document.getElementById('filter-order-price')
    if(filter_order_price) {
        let html = `
            <option value="">Pilih Kategori</option>
            <option value="1">Rendah ke Tinggi</option>
            <option value="2">Tinggi ke Rendah</option>
        `
        filter_order_price.innerHTML = html
    }
}

function selectOrderStockOption() {
    const filter_order_stock = document.getElementById('filter-order-quantity')
    if(filter_order_stock) {
        let html = `
            <option value="">Pilih Urutan Stok</option>
            <option value="1">Rendah ke Tinggi</option>
            <option value="2">Tinggi ke Rendah</option>
        `
        filter_order_stock.innerHTML = html
    }
}

function getFilter() {
    let filter = {}
    const category = document.getElementById('filter-category').value
    const order_price = document.getElementById('filter-order-price').value
    const order_quantity = document.getElementById('filter-order-quantity').value
    if(category) filter.filter_category = category
    if(order_price) filter.filter_order_price = order_price
    if(order_quantity) filter.filter_order_quantity

    return filter
}

function resetFilter() {
    const filter_select = document.getElementsByClassName('select');
    for(let i=0 ; i<filter_select.length ; i++) {
        filter_select[i].value = ''
    }
}
