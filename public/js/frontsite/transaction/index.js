const search_product = document.getElementById('search-product')
const clear_search = document.getElementById('clear-input')

let page = 1
getProductData(page)
let i = 0
search_product.addEventListener('submit', (event) => {
    event.preventDefault()
    const input_search = document.getElementById('input-search-product').value;
    getProductData(1, 'search', input_search);
})
clear_search.addEventListener('click', () => {
    getProductData(1, 'search');
})


function getProductData(page, type = 'all', params = '') {
    const load_data_field = getId('load-data');
    let url = base_url + '/product/getData';
    const inputParams = {}
    inputParams.page = page
    if(type == 'search') {
        load_data_field.innerHTML = ''
        inputParams.search = params;
        inputParams.page = 1
        const urlParams = new URLSearchParams(inputParams);
        url += '?' + urlParams
    }
    fetch(url, {
        method: 'get',
    })
    .then((response) => response.json())
    .then((data) => {
        let html = ``
        if(data.data.data.length > 0) {
            for(let i=0 ; i<data.data.data.length ; i++) {
                const value = data.data.data[i]
                const img_alt = base_url + '/assets/image/keranjang.jpg'
                if(value.image.length > 0) {
                    image_url = base_url + '/storage/' + value.image[0].path
                } else {
                    image_url = img_alt
                }
                html += `
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2 mb-3" id="product-${value.id}">
                    <div class="card">
                        <div class="card-body">
                            <div class="data-card-header">
                                <p class="my-0 fw-semibold" id="name-${value.id}" data-name="${value.name}">${value.name}</p>
                                <span class="fw-6 fw-semibold text-secondary">${value.category.name}</span>
                            </div>
                            <img src="${image_url}" class="my-4" alt="" style="height:5em;width:100%;object-fit:cover">
                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-success fw-semibold" id="price-${value.id}" data-price="${value.price}">Rp ${value.price}</span>
                                <span class="fw-semibold" id="quantity-${value.id}" data-quantity="${value.quantity}">${value.quantity} buah</span>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button class="btn btn-outline-primary btn-sm btn-add" id="add-${value.id}" data-id="${value.id}" title="Tambah">
                                    <i class="fas fa-check-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `
            }
        } else {
            html += `
                <div class="col-12 d-flex flex-column text-center p-4">
                    <h4 class="text-center">
                        <i class="fas fa-exclamation-triangle text-center"></i>
                    </h4>
                    Data tidak ditemukan
                </div>
            `
        }
        load_data_field.insertAdjacentHTML('beforeend', html)
        add_product()
    })
}

function add_product() {
    const btn_add_product = getClass('btn-add');
    for(let i=0 ; i<btn_add_product.length ; i++) {
        const btn_add = btn_add_product[i];
        btn_add.addEventListener('click', () => {
            const id = btn_add.getAttribute('data-id');
            if(getId('row-' + id)) {
                getId('input-quantity-' + id).value = parseInt(getId('input-quantity-' + id).value) + 1
                total_price_count()
            } else {
                const name = getId('name-' + id).getAttribute('data-name')
                const price = getId('price-' + id).getAttribute('data-price')
                let html = `
                    <div class="row row-transaction" id="row-${id}" data-id="${id}">
                        <div class="col-12 col-md-6 mb-3">
                            <input type="text" class="form-control product-name" value="${name}" id="input-name-${id}" disabled>
                        </div>
                        <div class="col-6 col-md-3 d-flex mb-3">
                            <button type="button" class="btn btn-secondary btn-sm mx-2 btn-qty-minus" id="btn-qty-minus-${id}" data-id="${id}">-</button>
                            <input type="number" class="form-control product-quantity" min="0" max="100" placeholder="0" value="1" id="input-quantity-${id}">
                            <button type="button" class="btn btn-secondary btn-sm mx-2 btn-qty-plus" id="btn-qty-plus-${id}" data-id="${id}">+</button>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <input type="number" class="form-control product-price" value="${price}" id="input-price-${id}" disabled>
                        </div>
                    </div>
                `
                const form = getId('form-transaction-input');
                form.insertAdjacentHTML('beforeend', html);
                qty_plus(id)
                qty_minus(id)
                qty_change(id)
                total_price_count()
            }
        })
    }
}

document.getElementById('btn-submit').addEventListener('click', () => {
    form_submit();
})


function qty_plus(id) {
    const btn_plus = getId('btn-qty-plus-' + id)
    btn_plus.addEventListener('click', () => {
        const id = btn_plus.getAttribute('data-id')
        const price = getId('input-price-' + id)
        let input_qty = getId('input-quantity-' + id)
        input_qty.value = parseInt(input_qty.value) + 1

        total_price_count()
    })
}

function qty_minus(id) {
    const btn_minus = getId('btn-qty-minus-' + id)
    btn_minus.addEventListener('click', () => {
        const id = btn_minus.getAttribute('data-id');
        const price = getId('input-price-' + id)
        let input_qty = getId('input-quantity-' + id)
        input_qty.value = parseInt(input_qty.value) - 1

        if(input_qty.value == 0) {
            const row = getId('row-' + id)
            row.remove()
        }
        total_price_count()
    })
}

function qty_change(id) {
    const input_qty = getId('input-quantity-' + id)
    input_qty.addEventListener('change', () => {
        if(input_qty.value <= 0) {
            const row = getId('row-' + id)
            row.remove()
        }
        total_price_count()
    })
}

function total_price_count() {
    const input_qty = getClass('product-quantity')
    const input_price = getClass('product-price')
    let total_price = 0;

    for(let i=0 ; i<input_qty.length ; i++) {
        const qty_val = parseInt(input_qty[i].value);
        const price_val = parseInt(input_price[i].value);

        total_price = total_price + (qty_val * price_val)
    }
    const transaction_total = getId('transaction-total')
    transaction_total.value = total_price;
}

function form_submit() {
    const row = document.getElementsByClassName('row-transaction')
    let formData = new FormData()
    for(let i=0 ; i<row.length ; i++) {
        const id = row[i].getAttribute('data-id')
        const quantity = getId('input-quantity-' + id).value
        formData.append('product_id[]', id)
        formData.append('quantity[]', quantity)
    }
    const total_price = getId('transaction-total').value
    const status = getId('transaction-status').value == 'on' ? 1 : 0
    const notes = getId('transaction-notes').value

    formData.append('total_price', total_price)
    formData.append('status', status)
    formData.append('notes', notes)
    const url = base_url + '/transaction'

    fetch(url, {
        headers: {
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        body: formData
    })
    .then((response) => {
        if(response.ok) {
            return response.json();
        }
        return response.text().then(text => {throw new Error(text)})
    })
    .then((data) => {
        const form_transaction_input = getId('form-transaction-input')
        const transaction_total = getId('transaction-total')
        swal.fire('Sukses', 'Berhasil menambahkan data', 'success')
        form_transaction_input.innerHTML = ''
        transaction_total.value = '0';

    })
    .catch((error) => {
        let resp = JSON.parse(error.message)
        let messages = ``
        resp.message.forEach(element => {
            console.log(element)
            messages += `${element}<br>`
        });
        swal.fire('Error', messages, 'error')
    })

    // form_transaction.addEventListener('submit', (event) => {
    //     event.preventDefault()

    // })
}
