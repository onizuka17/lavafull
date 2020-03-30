<template>
    <li class="node-tree">
        <span class="label"> 
            <input type="checkbox" name="cat_list_id" :value=node.id @click="setCatID" v-if="this.checkedID.indexOf(node.id) !== -1" checked="checked"  > 
            <input type="checkbox" name="cat_list_id" :value=node.id @click="setCatID" v-else > 
            {{ node.title }}
        </span>
        <ul v-if="node.hasChild && node.hasChild.length">
            <SubCategory v-for="child in node.hasChild" :node="child" :setCatID="setCatID" v-bind:key="child.id" :checkedID="checkedID"></SubCategory>
        </ul>
    </li>
</template>
<script>
export default {
    name: "SubCategory",
    props: {
        node: Object,
        setCatID: Function,
        checkedID: Array
    },
};

</script>
