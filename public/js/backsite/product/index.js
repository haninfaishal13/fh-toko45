const btn_filter = document.getElementById('filter')
const btn_reset_filter = document.getElementById('reset-filter')
const search_product = document.getElementById('search-product')
const import_product_form = document.getElementById('import-product-form')

let page = 1;
datacard(0)

btn_filter.addEventListener('click', () => {
    datacard(0, true)
})

btn_reset_filter.addEventListener('click', () => {
    page = 1
    resetFilter()
    datacard(0, true)
})

search_product.addEventListener('submit', (event) => {
    event.preventDefault()
    datacard(1)
})

import_product_form.addEventListener('submit', (event) => {
    event.preventDefault()
    import_product()
})

function datacard(search, filter = false) {
    const loaddatacard = document.getElementById('loadData')

    if(filter) {
        let page = 1
        loaddatacard.innerHTML = ''
    }
    const dataFilter = getFilter();

    dataFilter.page = page;
    if(search) {
        dataFilter.search = document.getElementById('search-input').value
        loaddatacard.innerHTML = ''
    }
    const params = new URLSearchParams(dataFilter)
    const url = base_url + '/backsite/product/datacard?' + params;

    fetch(url, {
        headers: {
            "X-CSRF-TOKEN": token
        },
        method: 'get'
    })
    .then((response) => response.json())
    .then((data) => {
        const img_alt = base_url + '/assets/image/keranjang.jpg'
        let html = ``;
        if(data.data.length > 0) {
            for(let i=0 ; i<data.data.length ; i++) {
                const value = data.data[i]
                let image_url
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
                                    <p class="my-0 fw-semibold">${value.name}</p>
                                    <span class="fw-6 fw-semibold text-secondary">${value.category.name}</span>
                                </div>
                                <img src="${image_url}" class="my-4" alt="" style="height:5em;width:100%;object-fit:cover">
                                <div class="d-flex justify-content-between">
                                    <span class="text-success fw-semibold">Rp${value.price}</span>
                                    <span class="fw-semibold">${value.quantity} buah</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-outline-primary btn-sm btn-detail" data-id="${value.id}" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-outline-primary btn-sm dropdown-toggle" id="navbarDropdown${value.id}" type="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item edit" href="${base_url + '/backsite/product/edit/' + value.id}" data-id="${value.id}">
                                                <i class="far fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete" href="javascript:void(0);" data-id="${value.id}">
                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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

        loaddatacard.insertAdjacentHTML('beforeend', html);
        const loadmore = document.getElementById('div-load-more');
        if(!data.next_page_url) {
            loadmore.classList.add('d-none')
        } else {
            loadmore.classList.remove('d-none')
        }
        deleteProduct()
    })
}

function deleteProduct() {
    const btn_delete = document.getElementsByClassName('delete')
    for(let i=0 ; i<btn_delete.length ; i++) {
        let btn = btn_delete[i]
        btn.addEventListener('click', () => {
            let id = btn.getAttribute('data-id');
            const url = base_url + '/backsite/product/delete/' + id;
            const formData = new FormData()
            formData.append('_method', 'delete')
            console.log(id, url);
            Swal.fire({
                title: 'Anda yakin ingin menghapus butir soal terpilih?',
                icon: 'question',
                showDenyButton: true,

                confirmButtonText: `Ya`,
                denyButtonText: `Kembali`,
            }).then((result) => {
                if(result.isConfirmed) {
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
                        swal.fire('Sukses', 'Berhasil hapus data', 'success')
                        document.getElementById('product-' + id).remove()
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
                }

            })
        })
    }
}

function import_product() {
    const import_product_form = document.getElementById('import-product-form')
    const formData = new FormData(import_product_form)
    const url = base_url + '/backsite/product/import'

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
        console.log(data);
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


}
