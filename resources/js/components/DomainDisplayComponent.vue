<template>
    <div class="w-100 mt-5">
        <div class="row">
            <div class="col-12 p-2">
                <button class="btn btn-outline-primary btn-block" @click="selectedAll()">
                    Show all links
                </button>
            </div>
            <div class="p-2 col-4" v-for="category in this.categories">
                <button class="btn btn-outline-primary btn-block" @click="selectedCat(category.id)">
                   {{category.category_name}}
                </button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="p-2 col-4" v-for="subcategory in filteredSubcategories">
                <button class="btn btn-outline-primary btn-block" @click="selectedSubCat(subcategory.id)">
                    {{subcategory.subcategory_name}}
                </button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 p-2" v-for="domain in filteredDomains">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Website name: </strong>{{domain.title}}</p>
                        <p><strong>Website URL: </strong><a :href="domain.url">{{domain.url}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>




<!--
<template>
    <div class="w-100 mt-5">
        <div class="row">
            <div class="col-12 p-2">
                <div class="categorybox w-100 align-items-center py-1" @click="selectedAll()">
                    <h5 class="text-center">Show all links</h5>
                </div>
            </div>
            <div class="p-2 col-4" v-for="category in this.categories">
                <div class="categorybox align-items-center py-1" @click="selectedCat(category.id)">
                    <h5 class="text-center">{{category.category_name}}</h5>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="p-2 col-4" v-for="subcategory in filteredSubcategories">
                <div class="categoryboxs w-100 align-items-center py-1" @click="selectedSubCat(subcategory.id)">
                    <h6 class="text-center">{{subcategory.subcategory_name}}</h6>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 p-2" v-for="domain in filteredDomains">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Website name: </strong>{{domain.title}}</p>
                        <p><strong>Website URL: </strong><a :href="domain.url">{{domain.url}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
-->


<script>
export default {
    props: ['domains', 'categories', 'subcategories'],
    data() {
        return {
            selectedCategory: '',
            selectedSubcategory: '',
        }
    },
    methods: {
        //Metodos para cuando clickeen sobre una categoria o subcategoria
        //Mostrar los datos asociados a la categoria o subcategoria seleccionada
        selectedCat: function(id){
            this.selectedCategory = id;
            this.selectedSubcategory = '';
        },
        selectedSubCat: function(id){
            this.selectedSubcategory = id;
        },
        selectedAll: function(){
            this.selectedCategory = '';
            this.selectedSubcategory = '';
        }
    },
    computed: {
        filteredSubcategories: function(){
            return this.subcategories.filter((item) => item.category_id == this.selectedCategory)
        },
        // Si se no se selecciona categoria o subcategoria (Show all links) se muestran todos los
        // dominios. si se selecciona una subcategoria, se muestran los dominios asociados a 
        // esa subcategoria. Si se selecciona una categoria y no tiene subcategoria, se muestran los
        // dominios asociados a esa categoria
        filteredDomains: function(){
            if (this.selectedCategory === '' && this.selectedSubcategory === '') {
                return this.domains;
            }else if (this.selectedCategory === '' && this.selectedSubcategory != '') {
                return this.domains.filter((item) => item.subcategory_id == this.selectedSubcategory);
            }else if (this.selectedCategory != '' && this.selectedSubcategory === '') {
                return this.domains.filter((item) => item.category_id == this.selectedCategory);
            }else if (this.selectedCategory != '' && this.selectedSubcategory != '') {
                return this.domains.filter((item) => item.subcategory_id == this.selectedSubcategory);
            }
        }
    },
}
</script>