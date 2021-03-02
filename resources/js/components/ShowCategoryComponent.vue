<template>
   <div>
       <div v-for="category in this.categories">
           <h4>{{ category.category_name }}</h4>
           <ul>
               <li v-for="subcat in category.subcategories">{{ subcat.subcategory_name }}</li>
           </ul>
       </div>
   </div>
</template>

<script>
    export default {
        props: ['categories'],
    }
</script>
