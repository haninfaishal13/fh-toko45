const edit_product_form = document.getElementById('edit-product-form')
const product_id = edit_product_form.getAttribute('data-id')
showData()

function showData() {
    let name = document.getElementById('product-name')
    let category = document.getElementById('filter-category')
    let quantity = document.getElementById('product-quantity')
    let price = document.getElementById('product-price')

    const url = base_url + '/backsite/product/showdata/' + product_id
    fetch(url, {
        method: 'get'
    })
    .then((response) => response.json())
    .then((data) => {
        const value = data.data
        name.value = value.name
        category.value = value.category_id
        quantity.value = value.quantity
        price.value = value.price
        let html = ``

        if(value.image.length > 0) {
            for(let i=0 ; i<value.image.length ; i++) {
                let image = value.image[i]
                html += `
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2 mb-3" id="img-col-${image.id}">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="${base_url + '/storage/' + image.path}" class="my-4" alt="" style="height:5em;width:100%;object-fit:cover">
                            <button type="button" class="btn btn-danger btn-sm btn-delete" id="img${image.id}" data-id="${image.id}"><i class="far fa-trash-alt me-2"></i>Hapus</button>
                        </div>
                    </div>
                </div>
                `

            }
            document.getElementById('exist-image').innerHTML = html
            deleteImage()
        }
    })
}

edit_product_form.addEventListener('submit', (event) => {
    event.preventDefault()
    const formData = new FormData(edit_product_form);
    formData.append('_method', 'put')
    const url = base_url + '/backsite/product/update/' + product_id

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

function deleteImage() {
    const btn_delete_image = document.getElementsByClassName('btn-delete')
    for(let i=0 ; i<btn_delete_image.length ; i++) {
        const btn_delete = btn_delete_image[i]
        btn_delete.addEventListener('click', () => {
            const id = btn_delete.getAttribute('data-id');
            const col_class = document.getElementById('img-col-' + id)
            let formDataDelete = new FormData()
            formDataDelete.append('_method', 'delete');
            const url_delete_image = base_url + '/backsite/product/image/delete/' + id;
            fetch(url_delete_image, {
                headers: {
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                body: formDataDelete
            })
            .then((response) => {
                if(response.ok) {
                    return response.json();
                }
                return response.text().then(text => {throw new Error(text)})
            })
            .then((data) => {
                col_class.remove()
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
    }
}
