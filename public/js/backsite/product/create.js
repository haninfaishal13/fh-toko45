const btn_newform = document.getElementById('new-form');
const add_product_form = document.getElementById('add-product-form')
// let product_data_count = 0
btn_newform.addEventListener('click', () => {
    const get_node = document.getElementsByClassName('product-data');
    const clone = get_node[0].cloneNode(true);
    document.getElementById('add-product').append(clone);
    const arr_input_class = ['product-name', 'product-quantity', 'product-price', 'product-image'];
    for(let i=0 ; i<arr_input_class.length ; i++) {
        const new_input = document.getElementsByClassName(arr_input_class[i])
        new_input[new_input.length - 1].value = '';
    }
    const btn_remove = document.getElementsByClassName('remove-form');
    for(let i=0 ; i<btn_remove.length ; i++) {
        btn_remove[i].classList.remove('d-none')
    }
    removeDataProduct()
})

add_product_form.addEventListener('submit', (event) => {
    event.preventDefault()
    const form = document.getElementById('add-product-form');
    const formData = new FormData(form);

    const url = base_url + '/backsite/product';
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
    .then((resp) => {
        swal.fire('Sukses', 'Berhasil menambahkan data', 'success')
        .then(() => {
            window.location = base_url + '/backsite/product'
        })
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
})

function removeDataProduct() {
    const btn_remove = document.getElementsByClassName('remove-form');
    for(let i=0 ; i<btn_remove.length ; i++) {
        btn_remove[i].addEventListener('click', () => {
            if(btn_remove.length > 1) {
                const parent = btn_remove[i].parentElement;
                parent.remove()
            }
            const btn_remove_new = document.getElementsByClassName('remove-form');
            if(btn_remove_new.length == 1) {
                btn_remove_new[0].classList.add('d-none');
            }
        })
    }
}
