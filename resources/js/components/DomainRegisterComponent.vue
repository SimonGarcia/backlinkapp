<template>
    <div>
        <form method="POST" enctype="multipart/form-data" @submit.prevent="submitDomain">
            <div class="form-group">
                <label for="category">Select a category</label>
                <!-- V-Model se usa para unir el id de la categoria con los datos agregados al fomulario -->
                <select class="form-control" id="category" v-model="form.category_id">
                    <option v-for="category in this.categories" :value="category.id">{{ category.category_name }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subcategory">Select a subcategory if you wish</label>
                <select class="form-control" id="subcategory" v-model="form.subcategory_id">
                    <option v-for="subcategory in this.filteredSubcategories" :value="subcategory.id">{{ subcategory.subcategory_name }}</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" :class="{ 'is-invalid' :form.errors.has('email') }" placeholder="Please enter your email Address..." v-model="form.email" @keydown="form.errors.clear('email')">
                    <div class="invalid-feeback" v-show="form.errors.has('email')" v-text="form.errors.get('email')"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="url">Email</label>
                    <input type="text" :class="{ 'is-invalid' :form.errors.has('url') }" class="form-control" placeholder="https://your.domain.com" v-model="form.url" @keydown="form.errors.clear('url')">
                    <div class="invalid-feeback" v-show="form.errors.has('url')" v-text="form.errors.get('url')"></div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="file" id="img" class="form-control-file" >
            </div>
            <div class="form-group">
                <label for="title">Title of your Domain</label>
                <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('title') }" v-model="form.title" @keydown="form.errors.clear('title')">
                <div class="invalid-feeback" v-show="form.errors.has('title')" v-text="form.errors.get('title')"></div>
            </div>
            <div class="form-group">
                <label for="shordesc">Short description</label>
                <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('shortdesc') }" v-model="form.shortdesc" @keydown="form.errors.clear('shortdesc')">
                <div class="invalid-feeback" v-show="form.errors.has('shortdesc')" v-text="form.errors.get('shortdesc')"></div>
            </div>
            <div class="form-group">
                <vue-editor v-model="form.desc"></vue-editor>
            </div>
            <div class="mx-auto w-50" ref="paypal"></div>
        </form>
        <div v-if="loading">Waiting for payment!</div>
    </div>
</template>

<script>
export default {
    //Para obtener los datos de la base de datos y cargarlos al select
    props: ['categories', 'subcategories'],
    data(){
        return{
            product:{
                description: "Payment for Backlink app",
                price: 9.99
            },
            //Para llenar los formularios con la data ingresada
            form: new Form({
                email: '',
                title: '',
                url: '',
                shortdesc: '',
                desc: '',
                paidFor: true,
                category_id: '1',
                subcategory_id: '',

            })
        }
    },

    //Script para agregar pagos de paypal
    mounted: function() {
        const script = document.createElement("script");
            script.src =
            "https://www.paypal.com/sdk/js?client-id=Ace6Yx0DZ15Z25-LUBIT-jNie4djizwKsRzzV1QHCoebY7Mo99yOIjwUIH6cFb2l43tReZBPJJVBqurJ";
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
    },

    methods:{
        setLoaded: function(){
            window.paypal
            .Buttons({
                createOrder: (data, actions)=>{
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: this.product.description,
                                amount: {
                                    currency_code: "USD",
                                    value: this.product.price
                                }
                            }
                        ]
                    });
                },
                onApprove: async (data, actions, resp)=>{
                    const order = await actions.order.capture();
                    this.data;
                    this.submitDomain();
                },
                onError: err => {
                    console.log(err);
                }
            })
            .render(this.$refs.paypal);
        },
        submitDomain(){
            let data = new FormData();
            data.append('title', this.form.title);
            data.append('email', this.form.email);
            data.append('url', this.form.url);
            data.append('shortdesc', this.form.shortdesc);
            data.append('desc', this.form.desc);
            data.append('paid', this.form.paidFor);
            data.append('category_id', this.form.category_id);
            data.append('subcategory_id', this.form.subcategory_id);
            if(document.getElementById('img').files[0]){
                 data.append('img', document.getElementById('img').files[0]);
            }
            axios.post('/domain', data)
            .then((response)=>{
                this.form.reset();
                window.location.href = "../"
            })
            .catch(error => this.form.errors.record(error.response.data));
        }
    },
    computed: {
            //filtrar las subcategorias de cada categoria
            filteredSubcategories: function() {
                return this.subcategories.filter((item) => item.category_id == this.form.category_id)
            }
        }
}
</script>